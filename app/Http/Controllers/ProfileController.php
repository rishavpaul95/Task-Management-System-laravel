<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Categories;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Update the user's profile information.
     */

    public function edit(Request $request): View
    {

        $categories = Categories::where('company_id', Auth::user()->company_id)->get();
        $selectedCategory = request('categoryFilter', 'all');
        $data = compact('categories', 'selectedCategory');
        return view('profile', [
            'user' => $request->user(),
        ])->with($data);
    }


    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();


        // Check if the user is an admin or super-admin
        if ($user->hasRole('admin') || $user->hasRole('super-admin')) {
            // Check if there are no other users with the role 'admin' or 'super-admin' in the same company
            $otherAdmins = User::where('company_id', $user->company_id)
                ->where('id', '!=', $user->id)
                ->where(function ($query) {
                    $query->whereHas('roles', function ($query) {
                        $query->whereIn('name', ['admin', 'super-admin']);
                    });
                })
                ->count();

            if ($otherAdmins == 0) {
                // Try to delete the company
                try {
                    Company::where('id', $user->company_id)->delete();
                } catch (\Exception $e) {
                    // Log the error message
                    Log::error('Failed to delete company: ' . $e->getMessage());
                }
            }
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

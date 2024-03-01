<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Leads;
use App\Services\Newsletter;
use Exception;
use Illuminate\Validation\ValidationException;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $selectedCategory = request('categoryFilter', 'all');
        $data = compact('categories', 'selectedCategory');
        return view("contact")->with($data);
    }

    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required | regex:/^[\pL\s\-]+$/u',
        'email' => 'required|email',
        'address' => 'required',
        'city' => 'required|regex:/^[\pL\s\-]+$/u',
        'zip' => 'required|numeric',
    ]);

    $lead = new Leads;
    $lead->name = $request['name'];
    $lead->email = $request['email'];
    $lead->address = $request['address'];
    $lead->city = $request['city'];
    $lead->zip = $request['zip'];

    $receiveProductInfo = $request->has('receive_product_info') ? 1 : 0;

    try {
        if ($receiveProductInfo == 1) {
            $newsletter = new Newsletter();
            $newsletter->subscribe($request->email);
            $lead->save();
            return view('lead_info_view', compact('lead'));

        } else{

            $lead->save();
            return view('lead_info_view', compact('lead'));
        }



    } catch (\Exception $e) {
        throw ValidationException::withMessages([
            'email' => 'This email could not be added to our newsletter list.'
        ]);
    }
}

}

<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {

        $categories = Categories::all();

        $data = compact('categories');
        return view("admincategory")->with($data);
    }

    public function store(Request $request)
    {

        if (Auth::check()) {
            $request->validate([
                'category' => 'required|string',
            ]);

            $category = new Categories;
            $category->category = $request->input('category');
            $category->save();

            return redirect('/categories');
        } else {
            return redirect('/login')->with('error', 'You must be logged in to perform this action.');
        }
    }

    public function delete($id)
    {
        $category = Categories::find($id);
        if ($category) {
            $category->delete();
            return redirect('/categories')->with('success', 'Category deleted successfully');
        } else {
            return redirect('/categories')->with('error', 'Category not found');
        }
    }

    public function edit(Request $request, $id)
    {

        $category = Categories::find($id);
        if (!$category) {
            return redirect('/categories')->with('error', 'Category not found');
        }

        $request->validate([
            'category' => 'required|string',
        ]);

        $category->category = $request->input('category');
        $category->save();

        return redirect('/categories')->with('success', 'Category updated successfully');
    }
}

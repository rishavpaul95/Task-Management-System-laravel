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
        return view("admincategory")->with(compact('categories'));
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

            return redirect('/admin/categories');
        } else {
            return redirect('/login')->with('error', 'You must be logged in to perform this action.');
        }
    }

    public function delete($id)
    {
        $category = Categories::find($id);
        if ($category) {
            $category->delete();
            return redirect('/admin/categories')->with('success', 'Category deleted successfully');
        } else {
            return redirect('/admin/categories')->with('error', 'Category not found');
        }
    }

    public function edit(Request $request, $id)
    {

        $category = Categories::find($id);
        if (!$category) {
            return redirect('/admin/categories')->with('error', 'Category not found');
        }

        $request->validate([
            'category' => 'required|string',
        ]);

        $category->category = $request->input('category');
        $category->save();

        return redirect('/admin/categories')->with('success', 'Category updated successfully');
    }
}

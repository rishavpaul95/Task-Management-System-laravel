<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Leads;



class ContactController extends Controller
{
    public function index()
    {
        return view("/contact");
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
        $lead->save();


        return redirect('/contact/success')->with('leadData', $lead);
    }

    public function success()
    {
        $leadData = session('leadData');

        // Check if leadData is not available or if there are any errors
        if (!$leadData) {
            return redirect('/contact');
        }

        return view('lead_info_view', compact('leadData'));
    }
}

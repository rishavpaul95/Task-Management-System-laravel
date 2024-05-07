<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Leads;
use App\Services\Newsletter;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Mail;

class ContactController extends Controller
{
    public function index()
    {
        session(['backUrl' => url()->previous()]);
        if (Auth::check()) {
            $categories = Categories::where('company_id', Auth::user()->company_id)->get();
            $selectedCategory = request('categoryFilter', 'all');
            $data = compact('categories', 'selectedCategory');
            return view("contact")->with($data);
        } else {
            return view("contact");
        }
    }

    public function store(Request $request)
    {

        $secretKey = env('RECAPTCHA_SECRET_KEY');

        $captchaResponse = $request->input("g-recaptcha-response");


        $url = "https://www.google.com/recaptcha/api/siteverify";


        $response = file_get_contents($url . "?secret=" . $secretKey . "&response=" . $captchaResponse);

        $responseData = json_decode($response);

        if (!$responseData->success) {
            throw ValidationException::withMessages([
                'captcha' => 'ReCaptcha Error'
            ]);
        }

        $request->validate([
            'name' => 'required | regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required|regex:/^[\pL\s\-]+$/u',
            'zip' => 'required|numeric',
            'receive_daily_updates' => 'required|boolean',
        ]);

        $lead = new Leads;
        $lead->name = $request['name'];
        $lead->email = $request['email'];
        $lead->address = $request['address'];
        $lead->city = $request['city'];
        $lead->zip = $request['zip'];
        $lead->daily_updates = $request['receive_daily_updates'];

        $receiveProductInfo = $request->has('receive_product_info') ? 1 : 0;
        $categories = Categories::all();
        $selectedCategory = request('categoryFilter', 'all');

        try {
            if ($receiveProductInfo == 1) {
                $newsletter = new Newsletter();
                $newsletter->subscribe($request->email);
            }
            $email = "deathfrost005@gmail.com";
            $leadInfo = "Name: {$lead->name}\nEmail: {$lead->email}\nAddress: {$lead->address}\nCity: {$lead->city}\nZip: {$lead->zip}\nDaily Updates: {$lead->daily_updates}";
            Mail::raw('Someone Contacted you with the following info: ' . "\n\n" . $leadInfo, function ($message) use ($email) {
                $message->to($email)
                    ->subject('TaskMan Contact');
            });
            $lead->save();
            $data = compact('lead','categories', 'selectedCategory');
            return view('lead_info_view')->with($data);
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list.'
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\ContactUs;

class ExtraController extends Controller
{
    public function privacy()
    {
        return view('frontend.extra.privacy_policy');
    }
    public function contact()
    {
        $address =  Setting::first();
        return view('frontend.extra.contact_us',compact('address'));
    }
    public function about()
    {
        return view('frontend.extra.about_us');
    }
    public function delivery()
    {
        return view('frontend.extra.delivery_information');
    }
    public function return()
    {
        return view('frontend.extra.return_policy');
    }
    public function storeContactUs(Request $request)
    {
        $data = new ContactUs();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone_number = $request->phone_number;
        $data->message = $request->message;
        $data->save();

        return back()->with('success', 'Your Message Send Successfully');
    }
    public function internationalOrders()
    {
        return view('frontend.extra.international_orders');
    }
    public function cancelPolicy()
    {
        return view('frontend.extra.cancel_policy');
    }
    public function highlightPolicy()
    {
        return view('frontend.extra.customer_highlight');
    }
}

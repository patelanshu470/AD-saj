<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\User;
use Auth;
use Hash;

class SettingController extends Controller
{
    public function index()
    {
        $edit_detail = Setting::first();
        return view('backend.setting.index',compact('edit_detail'));
    }
    public function createDetail(Request $request)
    {
        $adminDeatail = new Setting();
        $adminDeatail->street = $request->street;
        $adminDeatail->landmark = $request->landmark;
        $adminDeatail->area = $request->area;
        $adminDeatail->pincode = $request->pincode;
        $adminDeatail->city = $request->city;
        $adminDeatail->state = $request->state;
        $adminDeatail->country = $request->country;
        $adminDeatail->atype = "admin";
        $adminDeatail->phone_number = $request->mobile;
        $adminDeatail->email = $request->email;
        $adminDeatail->save();
        return back()->with('success', 'Detail created successfully');
    }
    public function editDetail(Request $request)
    {
        $edit_data = Setting::first();
        $adminDeatail = Setting::find($edit_data->id);
        $adminDeatail->street = $request->street;
        $adminDeatail->landmark = $request->landmark;
        $adminDeatail->area = $request->area;
        $adminDeatail->pincode = $request->pincode;
        $adminDeatail->city = $request->city;
        $adminDeatail->state = $request->state;
        $adminDeatail->country = $request->country;
        $adminDeatail->atype = "admin";
        $adminDeatail->phone_number = $request->mobile;
        $adminDeatail->email = $request->email;
        $adminDeatail->save();
        return back()->with('success', 'Detail edited successfully');
    }
    public function createSocial(Request $request)
    {
        $edit_data = Setting::first();
        $adminDeatail = Setting::find($edit_data->id);
        $adminDeatail->facebook_url = $request->facebook;
        $adminDeatail->instagram_url = $request->instagram;
        $adminDeatail->twitter_url = $request->twitter;
        $adminDeatail->linkedin_url = $request->linkedin;
        $adminDeatail->youtube_url = $request->youtube;
        $adminDeatail->save();

        return back()->with('success', 'Detail edited successfully');
    }

    public function ChangePassword(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);
        // old password match...
        if(!Hash::check($request->old_password, $user->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }
        // Update the new Password....
        $user->update([
            'password' => Hash::make($request->new_password),
            'confirm_password' => Hash::make($request->confirm_password)
        ]);
        return back()->with('success', 'Password Change Successfully');
    }
}

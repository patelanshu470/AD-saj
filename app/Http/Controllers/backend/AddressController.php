<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminAddress;

class AddressController extends Controller
{
    public function index()
    {
        $data  = AdminAddress::all();
        $edit_data = AdminAddress::first();
        // dd($edit_data);
        return view('backend.address.index',compact('data','edit_data'));
    }

    public function create(Request $request)
    {
        // dd($request->all());
        $adminAdress = new AdminAddress();
        $adminAdress->street = $request->street;
        $adminAdress->landmark = $request->landmark;
        $adminAdress->area = $request->area;
        $adminAdress->pincode = $request->pincode;
        $adminAdress->city = $request->city;
        $adminAdress->state = $request->state;
        $adminAdress->country = $request->country;
        $adminAdress->atype = "admin";
        $adminAdress->save();
        return back()->with('success', 'Address created successfully');
    }

    public function edit(Request $request)
    {
        $edit_data = AdminAddress::first();
        $adminAdress = AdminAddress::find($edit_data->id);
        $adminAdress->street = $request->street;
        $adminAdress->landmark = $request->landmark;
        $adminAdress->area = $request->area;
        $adminAdress->pincode = $request->pincode;
        $adminAdress->city = $request->city;
        $adminAdress->state = $request->state;
        $adminAdress->country = $request->country;
        $adminAdress->atype = "admin";
        $adminAdress->save();

        return back()->with('success', 'Address Update successfully');
    }
}

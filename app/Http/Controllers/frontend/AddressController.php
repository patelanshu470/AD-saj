<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function create(Request $request)
    {
        return view('frontend.user.address.create');
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $result=Address::create([
            'addresable_type' => 'App\Models\User',
            'user_id' => $user_id,
            'atype' => $request->atype,
            'country' => $request->country,
            'state' => $request->state,
            'city' =>$request->city,
            'street'=> $request->street,
            'landmark' => $request->landmark,
            'pincode'=> $request->pincode,
        ]);

        if ($result) {
            if (isset($request->default_address_id) && $request->default_address_id!='' && $request->default_address_id=='yes') {
                $customer=Auth::user();
                $customer->default_address_id=$result->id;
                $customer->save();
            }
            return redirect()->route('user.profile')
            ->with('success', 'Address Create Successfully');
        } else {
            return redirect()->route('addresses.create')
                    ->with('error', trans('translation.error'));
        }
    }

    public function UpdateDefaultAddress(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->default_address_id = $request->address_id;
        $user->save();

        return response()->json(['success'=>'Default address updated.']);
    }

    public function edit(Request $request,$id)
    {

        try {
              $id=decrypt($id);
                //  $order_id=decrypt($order_id);
        } catch (DecryptException $e) {
            throw new HttpResponseException(
               
                response()->view('errors.404', [], Response::HTTP_NOT_FOUND)
            );
        }
        $address = Address::find($id);
        return view('frontend.user.address.edit',compact('address'));
    }

    public function update(Request $request,$id)
    {
        
        try {
            $id=decrypt($id);
            // $order_id = decrypt($order_id);
        } catch (DecryptException $e) {
            throw new HttpResponseException(
              
                response()->view('errors.404', [], Response::HTTP_NOT_FOUND)
            );
        }

        $address = Address::find($id);
        $user_id = Auth::user()->id;
        // dd($request->all());
        $address->update([
            'addresable_type' => 'App\Models\User',
            'user_id' => $user_id,
            'atype' => $request->atype,
            'country' => $request->country,
            'state' => $request->state,
            'city' =>$request->city,
            'street'=> $request->street,
            'landmark' => $request->landmark,
            'pincode'=> $request->pincode,
        ]);

        if ($address) {
            if (isset($request->default_address_id) && $request->default_address_id!='' && $request->default_address_id=='yes') {
                $customer=Auth::user();
                $customer->default_address_id=$address->id;
                $customer->save();
            } else {
                $customer=Auth::user();
                $customer->default_address_id=null;
                $customer->save();
            }
            return redirect()->route('user.profile')
            ->with('success', 'Address Update Successfully');
        } else {
            return redirect()->route('user.profile')
            ->with('error', trans('translation.error'));
        }

    }

    public function delete($id)
    {
       

        try {
            $id=decrypt($id);
              //  $order_id=decrypt($order_id);
      } catch (DecryptException $e) {
          throw new HttpResponseException(
             
              response()->view('errors.404', [], Response::HTTP_NOT_FOUND)
          );
      }


        $address = Address::find($id);
        $user = Auth::user()->default_address_id;
        if (!$user == null) {
            if ($user == $id) {
                $customer=Auth::user();
                $customer->default_address_id=null;
                $customer->save();
            }
        }

        $address->delete();
        return back()->with('success','Address Deleted Successfully');

    }
}

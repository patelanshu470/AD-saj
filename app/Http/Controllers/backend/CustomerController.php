<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $data=User::where('is_admin','<>',1)->get();
        return view('backend.customers.customers',compact('data'));
    }

    public function view($id)
    {
        // $order = Order::where('user_id',$id)->orderBy('id','DESC')->get();
            $order = Order::where([['user_id','=',$id],['payment_status','<>','pending']])->orderBy('id','DESC')->get();

        $user = User::find($id);
        return view('backend.customers.view',compact('order','user'));
    }
}

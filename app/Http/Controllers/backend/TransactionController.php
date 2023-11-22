<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

use Razorpay\Api\Api;



class TransactionController extends Controller
{
    public function index(){
        $data=Payment::latest()->get();

        return view('backend.transactions.transactions',compact('data'));
    }
}

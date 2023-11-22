<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductColor;
use App\Models\Order;
use App\Models\OrderCancel;
use App\Models\OrderReturn;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        #Out of Stock
        $outofStock = ProductColor::with('getProductInformation')->where('quantity',0)->get();

        #Total Revenue
        $total_Revenue = Order::where('payment_status','captured')->sum('grand_total');
        $total_Dollar = Order::where('country_type','Dollar')->where('payment_status','captured')->sum('grand_total');
        $total_INR = Order::where('country_type','INR')->where('payment_status','captured')->sum('grand_total');
        $total_order = Order::where('payment_status','captured')->count();
        $total_orderCancel = OrderCancel::count();
        $total_orderReturn = OrderReturn::count();
        #Monthly Revenue
        $currentMonth = Carbon::now()->month;
        $total_Dollar_Monthly = Order::where('country_type', 'Dollar')->where('payment_status','captured')->whereMonth('created_at', $currentMonth)->sum('grand_total');
        $total_INR_Monthly = Order::where('country_type', 'INR')->where('payment_status','captured')->whereMonth('created_at', $currentMonth)->sum('grand_total');
        $total_order_Monthly = Order::whereMonth('created_at', $currentMonth)->where('payment_status','captured')->count();
        $total_orderCancel_Monthly = OrderCancel::whereMonth('created_at', $currentMonth)->count();
        $total_orderReturn_Monthly = OrderReturn::whereMonth('created_at', $currentMonth)->count();
        #Weekly Revenue
        $currentWeekStart = Carbon::now()->startOfWeek();
        $currentWeekEnd = Carbon::now()->endOfWeek();
        $total_Dollar_Weekly = Order::where('country_type', 'Dollar')->where('payment_status','captured')->whereBetween('created_at', [$currentWeekStart, $currentWeekEnd])->sum('grand_total');
        $total_INR_Weekly = Order::where('country_type', 'INR')->where('payment_status','captured')->whereBetween('created_at', [$currentWeekStart, $currentWeekEnd])->sum('grand_total');
        $total_order_Weekly = Order::whereBetween('created_at', [$currentWeekStart, $currentWeekEnd])->where('payment_status','captured')->count();
        $total_orderCancel_Weekly = OrderCancel::whereBetween('created_at', [$currentWeekStart, $currentWeekEnd])->count();
        $total_orderReturn_Weekly = OrderReturn::whereBetween('created_at', [$currentWeekStart, $currentWeekEnd])->count();

        return view('backend.admin.index',compact('outofStock','total_Revenue','total_INR','total_Dollar','total_order','total_orderCancel','total_orderReturn','total_Dollar_Monthly','total_INR_Monthly','total_order_Monthly','total_orderCancel_Monthly','total_orderReturn_Monthly','total_Dollar_Weekly','total_INR_Weekly','total_order_Weekly','total_orderCancel_Weekly','total_orderReturn_Weekly'));
    }
}

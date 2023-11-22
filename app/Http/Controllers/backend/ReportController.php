<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\OrderProduct;
use App\Models\Order;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MonthlySellReportExport;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $order = $request->input('order_type');
        $price = $request->input('price_type');
        $result = Order::query();
        if (!empty($month)) {
            $result->whereMonth('orders.created_at', $month);
        }
        if (!empty($order)) {
            if ($order == 'cancled') {
                $result->where('orders.status', '4');
            }
            if ($order == 'return') {
                $result->where('orders.status', '6');
            }
        }
        if (!empty($price)) {
            $result->where('orders.country_type', $price);
        }
        $MonthlySellReport = $result->with('address')->with('getOrderInformation')->where('payment_status', 'captured')->get();
        return view('backend.Report.index',compact('MonthlySellReport'));
    }

    public function ExpotReport(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $order = $request->input('order_type');
        $price = $request->input('price_type');
        $result = Order::query();
        if (!empty($month)) {
            $result->whereMonth('orders.created_at', $month);
        }
        if (!empty($order)) {
            if ($order == 'cancled') {
                $result->where('orders.status', '4');
            }
            if ($order == 'return') {
                $result->where('orders.status', '6');
            }
        }
        if (!empty($price)) {
            $result->where('orders.country_type', $price);
        }
        $carbonMonth = Carbon::createFromDate(null, $month, 1);
        $monthname = $carbonMonth->format('F');
        $MonthlySellReport = $result->with('address')->with('getOrderInformation')->where('payment_status', 'captured')->get();
        return Excel::download(new MonthlySellReportExport($MonthlySellReport), "{$monthname}_{$order}_{$price}_report.xlsx");
    }
}

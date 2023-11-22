<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\ProductColor;
use App\Models\OrderCancel;
use App\Models\OrderReturn;
use App\Models\Product;
use App\Models\Address;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use PDF;
use View;
use Mail;
use Carbon\Carbon;
use Auth;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $order = Order::orderBy('id','DESC');
        if ($request->input('status') != '') {
            $order = $order->where('status', $request->input('status'));
        }
        if ($request->input('price_type') != '') {
            $order = $order->where('country_type', $request->input('price_type'));
        }
        $order = $order->where([['payment_status','<>','pending']])->get();
        return view('backend.orders.orders',compact('order'));
    }

    public function view($id)
    {
        $order = Order::findOrfail($id);
        $payment_id_get = Payment::where('order_id',$id)->first();

        if ($order->country_type == 'Dollar') {
            # code...
            $environment = app()->environment();
            if ($environment == 'local' || $environment == 'staging') {
                \Stripe\Stripe::setApiKey(env('TEST_STRIPE_SECRET'));
            } else {
                \Stripe\Stripe::setApiKey(env('PROD_STRIPE_SECRET'));
            }
            try {
                $payment = \Stripe\PaymentIntent::retrieve($payment_id_get->payment_id);
                // Handle the payment data as needed
            } catch (\Stripe\Exception\ApiErrorException $e) {
                // Handle any errors from Stripe
                return response()->json(['error' => $e->getMessage()], 500);
            }
            if($payment->method == 'card') {
                $cardNetwork = $payment->card->network;
                $cardIssuer = $payment->card->issuer;
                $cardName = $payment->card->name;
                $cardLast4 = $payment->card->last4;
            }
        } else {
            $payment = null;
        }
        // $OrderProduct = OrderProduct::with('getproductsData')->where('order_id', $id)->orderBy('id', 'asc')->get();
        $OrderProduct = OrderProduct::with(['getproductsData' => function ($query) {
            $query->withTrashed();
        }])->where('order_id', $id)->orderBy('id', 'asc')->get();
        $billing_address = Address::where('order_id', $id)->where('atype', 'billing')->first();
        $shipping_address = Address::where('order_id', $id)->where('atype', 'shipping')->first();
        return view('backend.orders.view_order',compact('order', 'billing_address', 'shipping_address', 'OrderProduct','payment','payment_id_get'));
    }

    public function invoice()
    {
        $orders = Order::find(3);
        $billing_address = Address::where('order_id', 6)->where('atype', 'billing')->first();
        $shipping_address = Address::where('order_id', 6)->where('atype', 'shipping')->first();
        $productOrder = OrderProduct::with(['getproductsData' => function ($query) {
            $query->withTrashed();
        }])->where('order_id', 6)->orderBy('id', 'asc')->get();
        $payment= Payment::where('order_id',6)->first();
        return view('backend.orders.invoice',compact('orders','billing_address','shipping_address','productOrder','payment'));
    }

    public function invoiceView()
    {

        return view('backend.orders.invoice_view');
    }

    public function CheckNewOrder(Request $request)
    {
        $data = Order::where([['read_at',0],['payment_status','<>','pending']])->first();
        if(!$data == null) {
            return response()->json($data);
        }
    }

    public function ReadNewOrder(Request $request)
    {
        $data = Order::where([['read_at',0],['payment_status','<>','pending']])->first();
        $data->read_at = 1;
        $data->save();
    }

    public function orderStatus(Request $request)
    {
        $order = Order::find($request->order_id);
        $OrderProduct = OrderProduct::where('order_id', $request->order_id)->get();
        if ($request->status == 2) {
            if ($order->confirmed_at == null) {
                return response()->json(['error'=>'Order first Confirmed then shipped.']);
            }
        }
        if ($request->status == 3) {
            if ($order->shipped_at == null) {
                return response()->json(['error'=>'Order first Shipped then delivered.']);
            }
        }
        if ($request->status == 4) {
            $orderCancel = new OrderCancel();
            $orderCancel->order_id = $request->order_id;
            $orderCancel->user_id = Auth::user()->id;
            $orderCancel->reason = $request->canceled_reason;
            $orderCancel->save();
        }
        $order->status = $request->status;
        $order->save();

        if ($request->status == 1) {
            $now = Carbon::now();
            $order = Order::find($request->order_id);
            $order->confirmed_at = $now;
            $order->save();

            return response()->json(['success'=>'Order is Confirmed.']);
        }
        if ($request->status == 2) {
            $now = Carbon::now();
            $order = Order::find($request->order_id);
            $order->shipped_at = $now;
            $order->tracking_id = $request->tracking_id;
            $order->save();

            return response()->json(['success'=>'Order is Shipped.']);
        }
        if ($request->status == 3) {
            # order invoice...
            $orders = Order::find($request->order_id);
            // $productOrder = OrderProduct::with('getproductsData')->where('order_id', $request->order_id)->orderBy('id', 'asc')->get();
            $productOrder = OrderProduct::with(['getproductsData' => function ($query) {
                $query->withTrashed();
            }])->where('order_id', $request->order_id)->orderBy('id', 'asc')->get();
            $billing_address = Address::where('order_id', $request->order_id)->where('atype', 'billing')->first();
            $shipping_address = Address::where('order_id', $request->order_id)->where('atype', 'shipping')->first();
            $payment = Payment::where('order_id',$request->order_id)->first();
            $data["email"] = $orders->billing_contact_email;
            $data["title"] = "Sajh Dhaj Ke Invoice";

            $pdf = PDF::loadView('backend.orders.invoice', array('orders' =>  $orders,'billing_address'=>$billing_address,'shipping_address'=>$shipping_address,'productOrder'=>$productOrder,'payment'=>$payment));

            Mail::send('backend.orders.ordermail', $data, function ($message) use ($data, $pdf) {
                $message->to($data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "Sajh Dhaj Ke Invoice.pdf");
            });

            # product color quantity minus...
            // foreach ($OrderProduct as $OrderProducts) {
            //     $get_color_id = $OrderProducts->color_id;
            //     $product_color = ProductColor::find($get_color_id);
            //     $product_color_quantity = $product_color->quantity;
            //     $orderQuantity = $OrderProducts->quantity;
            //     $total = $product_color_quantity - $orderQuantity;
            //     $product_color->quantity = $total;
            //     $product_color->save();
            //     // dd($product_color->quantity);
            //     $data = ProductColor::where('id',$get_color_id)->whereRaw('CAST(quantity AS SIGNED) < CAST(max_quantity AS SIGNED)')->first();
            //     if ($data) {
            //         $data->read_at = "0";
            //         $data->save();
            //     }
            // }

            $now = Carbon::now();
            $order = Order::find($request->order_id);
            $order->delivered_at = $now;
            $order->save();
            return response()->json(['success'=>'Order is Delivered.']);
        }

        if ($request->status == 4) {
            $now = Carbon::now();
            $order = Order::find($request->order_id);
            $order->canceled_at = $now;
            $order->save();

            return response()->json(['success'=>'Order is Canceled.']);
        }

        if ($request->status == 5) {
            $now = Carbon::now();
            $order = Order::find($request->order_id);

            return response()->json(['success'=>'Order is Packed.']);
        }
    }

    public function OrderCanceled(Request $request)
    {

        // $order = OrderCancel::orderBy('id','DESC');
        // if ($request->input('price_type') != '') {
        //     $order = $order->join('orders', 'order_cancel.order_id', '=', 'orders.id')->where('orders.country_type', $request->input('price_type'));
        // }
        // $order = $order->get();
        $order = OrderCancel::orderBy('order_cancels.id', 'DESC'); // Specify the table name for the 'id' column

        if ($request->input('price_type') != '') {
            $order = $order->join('orders', 'order_cancels.order_id', '=', 'orders.id')
                           ->where('orders.country_type', $request->input('price_type'));
        }

        $order = $order->get();
        return view('backend.orders.order_canceled',compact('order'));
    }

    public function Confirmed()
    {
        $order = Order::where([['status','=',1],['payment_status','<>','pending']])->orderBy('id','DESC')->get();
        return view('backend.orders.confirm',compact('order'));
    }

    public function OrderReturn(Request $request)
    {
        $order = OrderReturn::orderBy('order_returns.id','DESC');
        if ($request->input('price_type') != '') {
            $order = $order->join('orders', 'order_returns.order_id', '=', 'orders.id')
                           ->where('orders.country_type', $request->input('price_type'));
        }
        $order = $order->get();
        return view('backend.orders.order_return',compact('order'));
    }

    public function OrderReturnStore(Request $request,$id)
    {
        $order = OrderReturn::FindOrFail($id);
        $order->status = $request->status;
        $order->reject_reason = $request->reject_reason;
        $order->save();
        return back()->with('success','stauts change successfully');
    }

    public function Delivered()
    {
        $order = Order::where([['status','=',3],['payment_status','<>','pending']])->orderBy('id','DESC')->get();
        return view('backend.orders.confirm',compact('order'));
    }
    public function generatePDF(Request $request,$id)
    {
        // dd($request->all());
        $data = [
            'title' => 'Welcome to Sajh Dhaj ke',
            'date' => date('m/d/Y')
        ];
        $orders = Order::find($id);
        // $productOrder = OrderProduct::with('getproductsData')->where('order_id', $id)->orderBy('id', 'asc')->get();
        $productOrder = OrderProduct::with(['getproductsData' => function ($query) {
            $query->withTrashed();
        }])->where('order_id', $id)->orderBy('id', 'asc')->get();
        $billing_address = Address::where('order_id', $id)->where('atype', 'billing')->first();
        $shipping_address = Address::where('order_id', $id)->where('atype', 'shipping')->first();
        $payment_data = Payment::where('order_id',$id)->first();
        $pdf = PDF::loadView('backend.orders.invoice', array('orders' =>  $orders,'billing_address'=>$billing_address,'shipping_address'=>$shipping_address,'productOrder'=>$productOrder,'payment'=>$payment_data));

        return $pdf->download('invoice.pdf');
    }

    public function orderConfirmation(Request $request)
    {
        $order = Order::orderBy('id','DESC');
        if ($request->input('price_type') != '') {
            $order = $order->where('country_type', $request->input('price_type'));
        }
        $order = $order->where([['status','=','0'],['payment_status','<>','pending']])->get();
        return view('backend.orders.order_confirmation',compact('order'));
    }

    public function orderConfirmationStatus(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->call_at = $request->status;
        $order->save();
        return response()->json([
            'success' => 'Order Call Done'
        ]);
    }

    public function AdminOrderNote(Request $request)
    {
        // dd($request->all());
        $order = Order::find($request->order_id);
        $order->admin_order_note = $request->notes;
        $order->save();
        return back()->with('success','Order Status Save');
    }

    public function Orderlabel()
    {
        $orders = Order::find(64);
        $shipping_address = Address::where('order_id', 64)->where('atype', 'shipping')->first();
        return view('backend.orders.order_label',compact('orders','shipping_address'));
    }
    public function OrderlabelDownload($id)
    {
        $data = [
            'title' => 'Welcome to Sajh Dhaj ke',
            'date' => date('m/d/Y')
        ];
        $orders = Order::find($id);
        $shipping_address = Address::where('order_id', $id)->where('atype', 'shipping')->first();
        // $pdf = PDF::loadView('backend.orders.order_label', array('orders' =>  $orders,'shipping_address'=>$shipping_address));
        $pdf = View::make('backend.orders.order_label', array('orders' =>  $orders,'shipping_address'=>$shipping_address));

        return $pdf->render();
    }
}

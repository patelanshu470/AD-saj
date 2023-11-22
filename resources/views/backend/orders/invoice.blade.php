<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>
<body>
    <table style="width: 100%">
        @php
            $Admin_Address = App\Models\Setting::first();
        @endphp
        <tr>
            <th colspan="3" style="text-align: left;">
                <?php $image_path = '/frontend/assets/imgs/theme/Invoice-logo.png'; ?>
                  <img src="{{ public_path() . $image_path }}" width="150" style="margin-right: 230px">
              </th>
              @if ($Admin_Address)
              <td >
                    {{ $Admin_Address->street }},<br>{{ $Admin_Address->landmark }}, <br>{{ $Admin_Address->area }} <br> {{ ucfirst($Admin_Address->city) }}, {{ ucfirst($Admin_Address->state) }} {{ $Admin_Address->pincode }}, <br>{{ ucfirst($Admin_Address->country) }}
            </td>
              @else
              <td>
                414-415, MBC,<br>Opp. Opera Bussiness Hub,<br> Lajamni Chowk, <br> Mota Varachha, Surat, Gujarat 394101
            </td>
              @endif
        </tr>
    </table>

    <table style="width:100%; margin-top:50px">
        <tr>
            <td width="50%">
               <span style="display: block;"><b>Order Id.</b></span>
                #{{ $orders->unique_id }}
            </td>
            <td width="50%" style="text-align: right !important;">
               <span style="display: block;"><b>Order Date.</b></span>
                {{date('d-m-Y h:i:s',strtotime($orders->created_at))}}
            </td>
        </tr>
    </table>
    <hr style="    border: 1px solid #EBECEE;
    margin-top: 30px;
    line-height: 22px;">
    <table style="width:100%;">
        <tr>
            <td width="50%">
                <span style="display: block;"><b>Billing Address</b></span>
                <p style="margin: 0">
                    {{$orders->billing_contact_name}}
                </p>
                <p style="margin-top:0">
                    {{$billing_address->street}} <br>
                    {{$billing_address->landmark}} <br>
                    {{ucfirst($billing_address->city)}}, {{ucfirst($billing_address->state)}}, {{$billing_address->pincode}} <br>
                    {{$billing_address->country}} <br>
                    <a href="#">
                        {{$orders->billing_contact_email}}
                    </a>
                </p>
            </td>
            <td width="50%" style="text-align: right !important;">
                <span style="display: block;"><b>Shipping Address</b></span>
                <p style="margin: 0">
                    {{$orders->shipping_contact_name}}
                </p>
                <p style="margin-top:0">
                    {{$shipping_address->street}} <br>
                    {{$shipping_address->landmark}} <br>
                    {{ucfirst($shipping_address->city)}}, {{ucfirst($shipping_address->state)}}, {{$shipping_address->pincode}} <br>
                    {{$shipping_address->country}} <br>
                    <a href="#">
                        {{$orders->shipping_contact_email}}
                    </a>
                </p>
            </td>
        </tr>
    </table>
    <table border="1" style="width: 100%; border-collapse: collapse; margin-top:20px; border: ">
        <thead>
            <tr>
                <th style="text-align:left">
                    <span style="display: block;">Name</span>
                </td>
                <th style="text-align:left">
                    <span style="display: block;">Price</span>
                </td>
                <th style="text-align:left">
                    <span style="display: block;">Quantity</span>
                </td>
                <th style="text-align:left">
                    <span style="display: block;">Discount</span>
                </td>
                <th style="text-align:left">
                    <span style="display: block;">Subtotal</span>
                </td>
                <th style="text-align:left">
                    <span style="display: block;">Tax Rate</span>
                </td>
                <th style="text-align:left">
                    <span style="display: block;">Tax Amount</span>
                </td>
                <th style="text-align:left">
                    <span style="display: block;">Total</span>
                </td>
            </tr>
            {{-- <tr>
                <td colspan="5"> <p style="border: 1px solid #EBECEE;
                    line-height: 22px;"></p></td>
            </tr> --}}
        </thead>

        <tbody>
            @foreach ($productOrder as $product)
                <tr>
                    <td>{{ $product->getproductsData->name }}</td>
                    @if ($orders->country_type == 'INR')
                        <td style="font-family: DejaVu Sans, sans-serif;font-size: 13px;"> &#x20b9;{{ number_format($product->original_price, 2, '.', ',') }}</td>
                    @else
                        <td style="font-family: DejaVu Sans, sans-serif;font-size: 13px;"> ${{ number_format($product->original_price, 2, '.', ',') }}</td>
                    @endif
                    <td >{{ $product->quantity }}</td>
                    @if ($orders->country_type == 'INR')
                        <td style="font-family: DejaVu Sans, sans-serif;font-size: 13px;">&#x20b9;{{ $product->discount }}</td>
                        <td style="font-family: DejaVu Sans, sans-serif;font-size: 13px;"> &#x20b9;{{ number_format($product->getproductsData->subtotal, 2, '.', ',') }}</td>
                        <td style="font-family: DejaVu Sans, sans-serif;font-size: 13px;"> {{ $product->getproductsData->tax_rate }}</td>
                        <td style="font-family: DejaVu Sans, sans-serif;font-size: 13px;">&#x20b9;{{ number_format($product->getproductsData->tax_amount, 2, '.', ',') }}</td>
                        <td style="font-family: DejaVu Sans, sans-serif;font-size: 13px;">&#x20b9;{{ number_format($product->total_price, 2, '.', ',') }}</td>
                    @else
                        <td style="font-family: DejaVu Sans, sans-serif;font-size: 13px;">&#x20b9;{{ $product->discount }}</td>
                        <td style="font-family: DejaVu Sans, sans-serif;font-size: 13px;">&#x20b9;{{ number_format($product->getproductsData->subtotal_dollar, 2, '.', ',') }}</td>
                        <td style="font-family: DejaVu Sans, sans-serif;font-size: 13px;"> {{ $product->getproductsData->tax_rate_dollar }}</td>
                        <td style="font-family: DejaVu Sans, sans-serif;font-size: 13px;">&#x20b9;{{ number_format($product->getproductsData->tax_amount_dollar, 2, '.', ',') }}</td>
                        <td style="font-family: DejaVu Sans, sans-serif;font-size: 13px;">&#x20b9;{{ number_format($product->total_price, 2, '.', ',') }}</td>
                    @endif
                </tr>
            @endforeach
            {{-- <tr>
                <td colspan="5"> <p style="border: 1px solid #EBECEE;
                    line-height: 22px;"></p></td>
            </tr> --}}
            <tr>
                <td colspan="5">
                    GSTIN NO. 24JBUPS5657B1Z1
                </td>
                {{-- <td></td>
                <td></td>
                <td></td> --}}
                <td style="text-align: right !important;" colspan="2">
                    <span style="margin-bottom: 7px;
                    font-size: 16px;
                    color: #555;"> <b>Total: </b></span> <br>
                    <span style="margin-bottom: 7px;
                    font-size: 16px;
                    color: #555;">
                       <b>Save Money:</b>
                    </span>
                </td>
                @if ($orders->country_type == 'INR')
                    <td style="font-family: DejaVu Sans, sans-serif;"><b>&#x20b9;{{ number_format($orders->grand_total, 2, '.', ',') }}</b> <br>
                        <span style="color:green"><b>&#x20b9;{{number_format($orders->total_discount,2)}}</b></span></td>
                @else
                    <td style="font-family: DejaVu Sans, sans-serif;"><b>${{ number_format($orders->grand_total, 2, '.', ',') }}</b> <br>
                        <span style="color:green"><b>${{number_format($orders->total_discount,2)}}</b></span></td>
                @endif
            </tr>
            </tr>
        </tbody>
    </table>
    <hr style="    border: 1px solid #EBECEE;
    margin-top: 30px;
    line-height: 22px;">

    <table border="1" style="width: 100%; border-collapse: collapse; margin-top:20px; border: ">
        <thead>
            <tr>
                <th style="padding: 8px;">Payment Id</th>
                <th>Payment Method</th>
                <th>Payment Date</th>
            </tr>
        </thead>
        <tbody>
            @if ($payment != null)
                <tr>
                    <td style="text-align: center; padding:10px">{{ $payment->payment_id }}
                    </td>
                    <td style="text-align: center">
                        {{ ucfirst($payment->payment_method) }}
                    </td>
                    <td style="text-align: center">
                        {{ $payment->created_at }}
                    </td>
                </tr>
            @else
                <tr>
                    <td style="text-align: center; padding:10px"> -
                    </td>
                    <td style="text-align: center">
                        -
                    </td>
                    <td style="text-align: center">
                        -
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
    <hr style="    border: 1px solid #EBECEE;
    margin-top: 30px;
    line-height: 22px;">
    @if ($orders->order_note != null)
    <table style="width: 100%">
        <tr>
            <td>
                <b>Extra Notes:</b>
                {{ $orders->order_note }}
            </td>
        </tr>
    </table>
    @endif
</body>
</html>

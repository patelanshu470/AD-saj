<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Label</title>
</head>
<style>
  body{
    font-family:'cambria';
  }
</style>
<body>
    <!-- first Template -->
    <table cellpadding="0" cellspacing="0" margin="0" padding="0" style="border:1px solid black; margin: auto;">
        <tbody>
            <tr>
                <td>
                    <table  border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding" style="background-color: rgb(255, 255, 255);">
                        <tbody>
                            <tr>
                            <td>
                                <table style="table-layout: fixed; width: 78%; height: 170px; border-right:1px solid black; ">
                                    <tbody>
                                        <tr>
                                            <td style="border-right: 1px solid black; padding: 0 !important;">
                                              <?php $image_path = '/public/frontend/assets/imgs/theme/Invoice-logo.png'; ?>
                                                <img src="{{ $image_path }}" alt="logo" width="150px">
                                            </td>
                                            
                                            <td style="text-align: center; width: 70%;">
                                                paste the shipping label here
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            <table style="table-layout: fixed; width: 78%; border-top:1px solid #000000;  border-bottom:1px solid #000000; border-right:1px solid black">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style=" padding-left: 30px; padding-top: 10px; padding-bottom: 10px;">
                                                <p style="text-transform: uppercase; font-family: cambria; margin: 0;font-size: 16px; font-weight: 700;">To,</p> 
                                                <p style="text-transform: uppercase; font-family: cambria; margin: 0;font-size: 16px; font-weight: 700; padding: 10px 0;">Name: <span style="color: black; font-weight: 500;">{{ ucfirst($orders->shipping_contact_name) }}</span></p> 
                                                <p style="text-transform: uppercase; font-family: cambria; margin: 0;font-size: 16px; font-weight: 700; padding-bottom: 10px;">Address: <span style="color: black; font-weight: 500;">{{ $shipping_address->street }}, {{ ucfirst($shipping_address->landmark) }}, </br><span style="padding-left:87px">{{ ucfirst($shipping_address->city) }}, {{ ucfirst($shipping_address->state) }}, {{ $shipping_address->pincode }}, </span></br><span style="padding-left:87px">{{ ucfirst($shipping_address->country) }}</span></span></p> 
                                                <p style="text-transform: uppercase; font-family: cambria; margin: 0;font-weight: 700;">Contact Number: <span style="color: black; font-weight: 500;">{{ $orders->shipping_contact_number }}</span></p>
                                            </div>
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table style="table-layout: fixed; width: 78%;  height: 100px; padding: 15px 25px; border-right:1px solid black">
                                <tbody>
                                    <tr>
                                        <td>
                                            <li style="padding-bottom: 10px;">
                                                Report Parcel Damage Immediately: Your Timely Action Matters!
                                             </li>
                                             <li style="padding-bottom: 10px;">
                                                Stay Alert:Don't Accept Open Parcels, Notify Us Instead!
                                             </li>
                                             <li>
                                                Capture Unboxing Moments:Video Documentation for Hassle-free Returns!
                                             </li>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
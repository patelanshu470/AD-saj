<table class="data-table table stripe hover nowrap">
    <thead>
        <tr>
            <th><b>Order_Date</b></th>
            <th><b>Order_ID</b></th>
            <th><b>State</b></th>
            <th><b>PinCode</b></th>
            <th><b>Bayer State</b></th>
            <th><b>Bayer Pin</b></th>
            <th><b>GST</b></th>
            <th><b>HSN Code</b></th>
            <th><b>GST Amount</b></th>
            <th><b>GST Rate</b></th>
            <th><b>Price</b></th>
            <th><b>Qty</b></th>
            <th><b>Status</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($MonthlySellReport as $datas)
            @foreach ($datas->getOrderInformation as $orders)
                <tr>
                    <td class="table-plus">
                        {{ date('d-m-Y',strtotime($datas->created_at)) }}
                    </td>
                    <td class="table-plus">{{ $datas->unique_id }}</td>
                    <td class="table-plus">Gujarat</td>
                    <td class="table-plus">395006</td>
                    <td class="table-plus">{{ $datas->address[0]->state }}</td>
                    <td class="table-plus">{{ $datas->address[0]->pincode }}</td>
                    <td class="table-plus">24JBUPS5657B1Z1</td>
                    <td class="table-plus">{{ $orders->getproductsData->hsn_code }}</td>
                    @if ($datas->country_type == "INR")
                        <td class="table-plus">₹{{ $orders->getproductsData->tax_amount }}</td>
                    @else
                        <td class="table-plus">${{ $orders->getproductsData->tax_amount }}</td>
                    @endif
                    <td class="table-plus">{{ $orders->getproductsData->tax_rate }}</td>
                    @if ($datas->country_type == "INR")
                        <td class="table-plus"> ₹{{ $orders->total_price }}</td>
                    @else
                        <td class="table-plus">${{ $orders->total_price }}</td>
                    @endif
                    <td class="table-plus">{{ $orders->quantity }}</td>
                    <td class="table-plus">
                        @if ($datas->status == 0)
                            <span class="badge badge-info mb-1"> Pending</span>
                        @endif
                        @if ($datas->status == 1)
                            <span class="badge badge-success mb-1"> Confirmed</span>
                        @endif
                        @if ($datas->status == 2)
                            <span class="badge badge-warning mb-1"> Shipped</span>
                        @endif
                        @if ($datas->status == 3)
                            <span class="badge badge-primary mb-1"> Delivered</span>
                        @endif
                        @if ($datas->status == 4)
                            <span class="badge badge-danger mb-1"> Canceled</span>
                        @endif
                        @if ($datas->status == 5)
                            <span class="badge badge-secondary mb-1"> Packed</span>
                        @endif
                        @if ($datas->status == 6)
                            <span class="badge badge-warning mb-1"> Return</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        @endforeach

    </tbody>
</table>

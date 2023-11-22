@foreach ($orderData as $order)
    <tr>
        <td>#{{ $order->id }}</td>
        <td>{{ date('F d, Y', strtotime($order->created_at)) }}
        </td>
        <td>
            @if ($order->status == 0)
                <span class=""> Pending</span>
            @endif
            @if ($order->status == 1)
                <span class=""> Confirmed</span>
            @endif
            @if ($order->status == 2)
                <span class=""> Shipped</span>
            @endif
            @if ($order->status == 3)
                <span class=""> Delivered</span>
            @endif
            @if ($order->status == 4)
                <span class=""> Canceled</span>
            @endif
        </td>
        @php
            $countryPrice = session()->get('processedData');
        @endphp
        @if ($countryPrice == 'IN')
            <td>₹{{ $order->grand_total }} for
                {{ count($order->getOrderInformation) }} item</td>
        @else
            <td>${{ $order->grand_total }} for
                {{ count($order->getOrderInformation) }} item</td>
        @endif

        <td><a href="{{ route('orderView', encrypt($order->id)) }}" class="btn-small d-block">View</a>
        </td>
    </tr>
@endforeach

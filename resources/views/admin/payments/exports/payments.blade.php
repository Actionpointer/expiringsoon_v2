<table>
    <thead>
        <tr>
            <td colspan="6">Payments </td>
        </tr>
        <tr>
            <th>Date</th>
            <th>Reference</th>
            <th>Paid By</th>
            <th>Method</th>
            <th>Currency</th>
            <th>Discount</th>
            <th>Amount</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    @foreach($payments as $payment)
        <tr>
            <td>{{ $payment->created_at->format('d-M-Y') }}</td>
            <td>{{ $payment->reference }}</td>
            <td>{{ $payment->user->name }}</td>
            <td>{{ $payment->method }}</td>
            <td>{{$payment->currency->iso}}</td>
            <td>{{ number_format($payment->coupon_value)}}</td>
            <td>{{ number_format($payment->payable, 2)}}</td>
            <td>{{ $payment->status}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
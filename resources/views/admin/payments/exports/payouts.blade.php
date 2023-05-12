<table>
    <thead>
        <tr>
            <td colspan="6">Payouts </td>
        </tr>
        <tr>
            <th>Date</th>
            <th>Reference</th>
            <th>Shop</th>
            <th>Beneficiary</th>
            <th>Channel</th>
            <th>Currency</th>
            <th>Amount</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    @foreach($payouts as $payout)
        <tr>
            <td>{{ $payout->created_at->format('d-M-Y') }}</td>
            <td>{{ $payout->reference }}</td>
            <td>{{ $payout->shop->name }}</td>
            <td>{{ $payout->user->name }}</td>
            <td>{{ $payout->destination }}</td>
            <td>{{$payout->currency->iso}}</td>
            <td>{{ number_format($payout->amount, 2)}}</td>
            <td>@if($payout->status == 'paid') Paid on {{$payout->paid_at->format('d-M-Y')}} @else {{$payout->status }} @endif</td>
        </tr>
    @endforeach
    </tbody>
</table>
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
            <th>Account</th>
            <th>Currency</th>
            <th>Amount</th>
            <th>Paid Date</th>
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
            <td> @if($payout->channel =="bankaccount") {{$payout->user->bankaccount->bank->name}}  @else {{$payment->channel}} @endif </td>
            <td>@if($payout->channel == "bankaccount") {{$payout->user->bankaccount->account_number}} @else {{$payout->user->payout_account}}</td>
            <td>{{$payout->currency->iso}}</td>
            <td>{{ number_format($payout->amount, 2)}}</td>
            <td>@if($payout->paid_at) {{$payout->paid_at->format('d-M-Y')}} @endif </td>
            <td>{{$payout->status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
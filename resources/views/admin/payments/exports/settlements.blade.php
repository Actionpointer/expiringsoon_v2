<table>
    <thead>
    <tr>
        <td colspan="6">Settlements </td>
    </tr>
    <tr>
        <th>Date</th>
        <th>Beneficiary</th>
        <th>Purpose</th>
        <th>Location</th>
        <th>Currency</th>
        <th>Amount</th>
        
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($settlements as $settlement)
        <tr>
            <td>{{ $settlement->created_at->format('d-M-Y') }}</td>
            <td>{{ $settlement->receiver->name }}</td>
            <td>{{ $settlement->description }}</td>
            <td>{{ $settlement->receiver->country->name }}</td>
            <td>{{$settlement->receiver->country->currency->iso}}</td>
            <td>{{ number_format($settlement->amount, 2)}}</td>
            <td>{{ $settlement->status ? 'Paid': 'Pending' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
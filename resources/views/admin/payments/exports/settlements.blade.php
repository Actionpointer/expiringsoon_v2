<table>
    <caption>Settlements </caption>
    <thead>
    <tr>
        <th>Date</th>
        <th>Beneficiary</th>
        <th>Location</th>
        <th>Amount</th>
        <th>Purpose</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($settlements as $settlement)
        <tr>
            <td>{{ $settlement->created_at->format('d-M-Y') }}</td>
            <td>{{ $settlement->receiver->name }}</td>
            <td>{{ $settlement->receiver->country->name }}</td>
            <td>{!!$settlement->receiver->country->currency->symbol!!}{{ number_format($settlement->amount, 2)}}</td>
            <td>{{ $settlement->description }}</td>
            <td>{{ $settlement->status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
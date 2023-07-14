<table>
    <thead>
        <tr>
            <td colspan="5">Revenues </td>
        </tr>
        <tr>
            <th>Date</th>
            <th>Country</th>
            <th>Description</th>
            <th>Currency</th>
            <th>Amount</th>
            <th>Payment Reference</th>
        </tr>
    </thead>
    <tbody>
    @foreach($revenues as $revenue)
        <tr>
            <td>{{ $revenue->created_at->format('d-M-Y') }}</td>
            <td>{{ $revenue->country->name }}</td>
            <td>{{ ucwords($revenue->description) }}</td>
            <td>{{ $revenue->currency->iso }}</td>
            <td>{{ number_format($revenue->amount, 2)}}</td>
            <td>{{ $revenue->payment->reference }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
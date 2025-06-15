<table>
    <thead>
        <tr>
            <td colspan="6">Coupons </td>
        </tr>
        <tr>
            <th>Title</th>
            <th>Code</th>
            <th>Start</th>
            <th>End</th>
            <th>Role</th>
            <th>Country</th>
            
        </tr>
    </thead>
    <tbody>
    @foreach($coupons as $coupon)
        <tr>
            
            <td>{{ $coupon->name }}</td>
            <td>{{ $coupon->code }}</td>
            <td>{{$coupon->start_at->format('d-M-Y')}}</td>
            <td>{{$coupon->end_at->format('d-M-Y')}}</td>
            <td>{{ $coupon->role }}</td>
            <td>{{$coupon->country->name}}</td>
            
        </tr>
    @endforeach
    </tbody>
</table>
@if(Session::has('result'))
    <div class="mb-0 @if(Session('result')) notify @else error @endif" >
        <p style="color:#fff">{{Session('message')}}</p>
    </div>
@endif
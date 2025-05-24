<div class="js-nav-scroller hs-nav-scroller-horizontal">
    <span class="hs-nav-scroller-arrow-prev" style="display: none;">
        <a class="hs-nav-scroller-arrow-link" href="javascript:;">
            <i class="bi-chevron-left"></i>
        </a>
    </span>

    <span class="hs-nav-scroller-arrow-next" style="display: none;">
        <a class="hs-nav-scroller-arrow-link" href="javascript:;">
            <i class="bi-chevron-right"></i>
        </a>
    </span>

    <!-- Nav -->
    <ul class="nav nav-segment nav-fill" id="featuresTab" role="tablist">   
        <li class="nav-item" role="presentation">
            <a class="nav-link @if(Route::is('admin.finance.withdrawals')) active @endif" href="{{route('admin.finance.withdrawals')}}">Withdrawals</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link @if(Route::is('admin.finance.settlements')) active @endif" href="{{route('admin.finance.settlements')}}">Settlements</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link @if(Route::is('admin.finance.payments')) active @endif" href="{{route('admin.finance.payments')}}">Payments</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link @if(Route::is('admin.finance.revenues')) active @endif" href="{{route('admin.finance.revenues')}}">Revenues</a>
        </li>
    </ul>
    <!-- End Nav -->
</div>
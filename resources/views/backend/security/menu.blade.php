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
    <ul class="nav nav-segment nav-fill" id="featuresTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link @if(Route::is('admin.security.logins')) active @endif" href="{{ route('admin.security.logins') }}">Logins</a>
        </li>

        <li class="nav-item" role="presentation">
            <a class="nav-link @if(Route::is('admin.security.apis')) active @endif" href="{{ route('admin.security.apis') }}">APIs</a>
        </li>
    </ul>
</div>
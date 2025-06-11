<!-- Setup Navigation -->
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-sm">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter">
                    <li class="breadcrumb-item"><a href="{{route('admin.settings.index')}}">Settings</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.settings.countries.index')}}">Countries</a></li>
                    <li class="breadcrumb-item active">{{$country->name}}</li>
                </ol>
            </nav>
            <h1 class="page-header-title">{{$country->name}} Setup</h1>
        </div>
    </div>
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

        <ul class="nav nav-tabs page-header-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link @if(request()->is('*/settings/countries/financials/*')) active @endif" href="{{ route('admin.settings.countries.financials', $country) }}">
                    <i class="bi-bank me-1"></i> Financials
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->is('*/settings/countries/subscription-plans/*')) active @endif" href="{{ route('admin.settings.countries.subscription_plans', $country) }}">
                    <i class="bi-box me-1"></i> Subscription Plans
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->is('*/settings/countries/ad-plans/*')) active @endif" href="{{ route('admin.settings.countries.ad_plans', $country) }}">
                    <i class="bi-badge-ad me-1"></i> Ad Plans
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->is('*/settings/countries/newsletter-plans/*')) active @endif" href="{{ route('admin.settings.countries.newsletter_plans', $country) }}">
                    <i class="bi-envelope-paper me-1"></i> Newsletter Plans
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(request()->is('*/settings/countries/verification/*')) active @endif" href="{{ route('admin.settings.countries.verifications', $country) }}">
                    <i class="bi-shield-check me-1"></i> Verification
                </a>
            </li>

        </ul>
    </div>
</div>
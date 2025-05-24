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

    <ul class="nav nav-tabs page-header-tabs" id="projectsTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('*/settings') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">General</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('*/settings/currencies') ? 'active' : '' }}" href="{{ route('admin.settings.currencies.index') }}">Currencies</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('*/settings/places') ? 'active' : '' }}" href="{{ route('admin.settings.places.index') }}">Places</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('*/settings/categories') ? 'active' : '' }}" href="{{ route('admin.settings.categories.index') }}">Categories</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('*/settings/attributes') ? 'active' : '' }}" href="{{ route('admin.settings.attributes.index') }}">Attributes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('*/settings/staff') ? 'active' : '' }}" href="{{ route('admin.settings.staff.index') }}">Staff</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('*/settings/security') ? 'active' : '' }}" href="{{ route('admin.settings.security.index') }}">Security</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('*/settings/plans') ? 'active' : '' }}" href="{{ route('admin.settings.plans.index') }}">Plans</a>
        </li>

    </ul>
</div>
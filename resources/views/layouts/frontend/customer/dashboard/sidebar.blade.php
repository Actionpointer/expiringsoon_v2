<div class="pt-10 pe-lg-10">
    <!-- nav -->
    <ul class="nav flex-column nav-pills nav-pills-dark">
        <!-- nav item -->
        <li class="nav-item">
            <a class="nav-link active" href="{{route('dashboard')}}">
                <i class="feather-icon icon-home me-2"></i>
                Dashboard
            </a>
        </li>
        <!-- nav item -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('wishlist')}}">
                <i class="feather-icon icon-heart me-2"></i>
                Wishlist
            </a>
        </li>
        <!-- nav item -->
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{route('orders')}}">
                <i class="feather-icon icon-shopping-bag me-2"></i>
                Your Orders
            </a>
        </li>
        <!-- nav item -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('addresses')}}">
                <i class="feather-icon icon-map-pin me-2"></i>
                Address
            </a>
        </li>
        
        <!-- nav item -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('followings')}}">
                <i class="feather-icon icon-users me-2"></i>
                Followings
            </a>
        </li>
        
        <!-- nav item -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('notifications')}}">
                <i class="feather-icon icon-bell me-2"></i>
                Notification
            </a>
        </li>
        
        <!-- nav item -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('profile')}}">
                <i class="feather-icon icon-settings me-2"></i>
                Profile Settings
            </a>
        </li>
        <!-- nav item -->
        <li class="nav-item">
            <hr />
        </li>
        <!-- nav item -->
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="feather-icon icon-log-out me-2"></i>
                Log out
            </a>
        </li>
    </ul>
</div>
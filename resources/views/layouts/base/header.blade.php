<header id="header"
    class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-container navbar-bordered bg-white">
    <div class="navbar-nav-wrap">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}" aria-label="Front">
            @include('layouts.base.snippets.logo')
        </a>
        <!-- End Logo -->

        @include('layouts.base.snippets.search')

        <div class="navbar-nav-wrap-content-end">
            <!-- Navbar -->
            <ul class="navbar-nav">
                @include('layouts.base.snippets.messages')

                @include('layouts.base.snippets.notifications')

                @include('layouts.base.snippets.activities')

                
                @include('layouts.base.snippets.admin')
                
            </ul>
            <!-- End Navbar -->
        </div>
    </div>
</header>
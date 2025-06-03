<header id="header"
    class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-container navbar-bordered bg-white">
    <div class="navbar-nav-wrap">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}" aria-label="Front">
            @include('layouts.backend.snippets.logo')
        </a>
        <!-- End Logo -->

        @include('layouts.backend.snippets.search')

        <div class="navbar-nav-wrap-content-end">
            <!-- Navbar -->
            <ul class="navbar-nav">
                @include('layouts.backend.snippets.messages')

                @include('layouts.backend.snippets.notifications')

                @include('layouts.backend.snippets.activities')

                
                @include('layouts.backend.snippets.admin')
                
            </ul>
            <!-- End Navbar -->
        </div>
    </div>
</header>
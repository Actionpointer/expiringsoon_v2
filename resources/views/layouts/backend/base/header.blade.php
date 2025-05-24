<header id="header"
    class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-container navbar-bordered bg-white">
    <div class="navbar-nav-wrap">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}" aria-label="Front">
            @include('layouts.snippets.logo')
        </a>
        <!-- End Logo -->

        @include('layouts.snippets.search')

        <div class="navbar-nav-wrap-content-end">
            <!-- Navbar -->
            <ul class="navbar-nav">
                @include('layouts.snippets.messages')

                @include('layouts.snippets.notifications')

                @include('layouts.snippets.activities')

                
                @include('layouts.snippets.admin')
                
            </ul>
            <!-- End Navbar -->
        </div>
    </div>
</header>
<x-customer-app>
<section>
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center d-md-none py-4">
                    <!-- heading -->
                    <h3 class="fs-5 mb-0">Menu</h3>
                    <!-- button -->
                    <button class="btn btn-outline-gray-400 text-muted d-md-none btn-icon btn-sm ms-3"
                        type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAccount"
                        aria-controls="offcanvasAccount">
                        <i class="bi bi-text-indent-left fs-3"></i>
                    </button>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-12 border-end d-none d-md-block">
                @livewire('layouts.customer.sidebar.menus')
            </div>
            <div class="col-lg-9 col-md-8 col-12">
                {{ $slot }}
            </div>
        </div>
    </div>
</section>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasAccount" aria-labelledby="offcanvasAccountLabel">
    <!-- offcanvac header -->
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasAccountLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <!-- offcanvac body -->
    <div class="offcanvas-body">
        <!-- nav -->
        @livewire('layouts.customer.sidebar.menus')

    </div>
</div>
</x-customer-app> 
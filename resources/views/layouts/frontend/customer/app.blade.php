<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta content="Codescandy" name="author">
	<title>Homepage v1 - eCommerce HTML Template - FreshCart</title>
	@livewireStyles
	@stack('styles')

	<!-- Favicon icon-->
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/images/favicon/favicon.ico')}}">


	<!-- Libs CSS -->
	<link href="{{asset('frontend/libs/bootstrap-icons/font/bootstrap-icons.min.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/libs/feather-webfont/dist/feather-icons.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/libs/simplebar/dist/simplebar.min.css')}}" rel="stylesheet">


	<!-- Theme CSS -->
	<link rel="stylesheet" href="{{asset('frontend/css/theme.min.css')}}">
</head>

<body>
	<!-- navbar -->
	<div class="border-bottom">
		@livewire('layouts.customer.header.top')
		@livewire('layouts.customer.header.menus')
	</div>

	<!-- Modal -->
	@livewire('layouts.customer.modals.signup')
	@livewire('layouts.customer.modals.signin')
	@livewire('layouts.customer.modals.cart-canvas')
	@livewire('layouts.customer.modals.product-modal-view')
	@livewire('layouts.customer.modals.workplaces')
	<!-- Modal -->
	
	@yield('content', $slot ?? '')

	@include('layouts.frontend.customer.footer')

	<!-- Javascript-->

	<!-- Libs JS -->
	<!-- <script src="assets/libs/jquery/dist/jquery.min.js"></script> -->
	<script data-navigate-once src="{{asset('frontend/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('frontend/libs/simplebar/dist/simplebar.min.js')}}"></script>
	<script src="{{asset('frontend/js/vendors/jquery.min.js')}}"></script>
	<script src="{{asset('frontend/js/vendors/password.js')}}"></script>
	@livewireScripts
	<script>
		$(document).ready(function() {
			Livewire.on('closeModal', function(data) {
				console.log('Close modal event received:', data);
				const modalId = data[0].modalId;

				const modalEl = document.getElementById(modalId);

				// Check if Bootstrap modal instance already exists
				let modalInstance = bootstrap.Modal.getInstance(modalEl);
				if (!modalInstance) {
					// If not, create a new instance (Bootstrap 5)
					modalInstance = new bootstrap.Modal(modalEl);
				}
				// Hide the modal with Bootstrap 5 API
				modalInstance.hide();
			});
		});
	</script>
	@stack('scripts')
	<!-- Theme JS -->
	<script src="{{asset('frontend/js/theme.min.js')}}"></script>



</body>

</html>
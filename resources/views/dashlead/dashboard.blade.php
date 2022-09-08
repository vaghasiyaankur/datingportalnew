<!-- Developed By CBS -->
@extends('dashlead.layouts.layout')
@section('pageTitle', 'Hjem')

@push('style')
@endpush
@section('content')
		<!-- Main Content-->
			<div class="main-content pt-0">
				<div class="container">
				<!-- Page Header -->
					<div class="page-header"></div>
				<!-- End Page Header -->

					<!-- Row -->
						<div class="row">
					
							<!-- Sidebar Section -->  
								<div class="col-md-3 col-lg-3">
									@include('dashlead.layouts.sectionOne')
								</div>
							<!-- Sidebar Section -->

							<!-- Sidebar Section -->  
								<div class="col-md-6 col-lg-6">
									@include('dashlead.layouts.sectionTwo')
								</div>
							<!-- Sidebar Section -->

							<!-- Promotion Section -->  
								<div class="col-md-3 col-lg-3">
									@include('dashlead.layouts.promotationsection')
								</div>
							<!-- Promotion Section -->

						</div>
					<!-- End Row -->
				</div>
			</div>
			
		<!-- End Main Content-->
@endsection

@push('script')

		<!-- Select2 JS -->
					<script type="text/javascript" language="javascript" >
							$(document).ready(function() {
							$('.seclect2').select2();
							$('#qslocation').select2();
							$('#qssex').select2();
							$('#qsto').select2();
							$('#qsfrom').select2();
							});
					</script>
		<!-- Select2 JS -->

		<!-- Announcement Slider JS -->
			<script>
			var swiper = new Swiper('.swiper-container', {
				spaceBetween: 30,
				centeredSlides: true,
				autoplay: {
					delay: 10000,
					disableOnInteraction: false,
				},
				pagination: {
					el: '.swiper-pagination',
					clickable: true,
				},
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
				});
			</script>
		<!-- Announcement Slider JS -->

		<!-- Wall Slider JS -->
			<script>
			var swiper = new Swiper('.wall-container', {
				spaceBetween: 30,
				centeredSlides: true,
				autoplay: {
					delay: 10000,
					disableOnInteraction: false,
				},
				pagination: {
					el: '.wall-pagination',
					clickable: true,
				},
				navigation: {
					nextEl: '.wall-button-next',
					prevEl: '.wall-button-prev',
				},
				});
			</script>
		<!-- Wall Slider JS -->
@endpush
<!-- Developed By CBS -->
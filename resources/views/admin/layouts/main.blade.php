<!doctype html>
<html class="fixed">
@php
	use App\Model\Admin\Usergroup;
@endphp
<head>

	<!-- Basic -->
	<meta charset="UTF-8">

	<title>Admin Dashboard - @yield('title')</title>
	<meta name="keywords" content="" />
	<meta name="description" content="">
	<meta name="author" content="">
	{{-- <link rel="shortcut icon" href="{{ asset('assets/img/favicon/favicon-16x16.png') }}">
	<link rel="icon" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}" type="image/png" sizes="16x16"> --}}
	  <!-- Favicons -->
		<link rel="shortcut icon" href="{{asset('assets/img/favicon/favicon-32x32.png')}}" type="image/x-icon">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<!-- Web Fonts  -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="{{ asset('admin/assets/vendor/bootstrap/css/bootstrap.css') }}" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" />
	<link rel="stylesheet" href="{{ asset('admin/assets/vendor/magnific-popup/magnific-popup.css') }}" />
	<link rel="stylesheet" href="{{ asset('admin/assets/vendor/bootstrap-datepicker/css/datepicker3.css') }}" /> @yield('styles')

	<!-- Theme CSS -->
	<link rel="stylesheet" href="{{ asset('admin/assets/stylesheets/theme.css') }}" />

	<!-- Specific Page Vendor CSS -->
	<link rel="stylesheet" href="{{ asset('admin/assets/vendor/pnotify/pnotify.custom.css') }}" />


	<!-- Skin CSS -->
	<link rel="stylesheet" href="{{ asset('admin/assets/stylesheets/skins/default.css') }}" />

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="{{ asset('admin/assets/stylesheets/theme-custom.css') }}">

	<!-- Head Libs -->

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

</head>

<body>
	<section class="body">
		<!-- start: header -->
		<header class="header">
			<div class="logo-container">
				<a href="{{ route('admin.index') }}" class="logo">
						<img src="{{ Menu::company() ? asset('storage/app/public/company/'.Menu::company()->logo) : 'No logo' }}" height="35" alt="JSOFT Admin" />
					</a>
				<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
					<i class="fas fa-bars" aria-label="Toggle sidebar"></i>
				</div>
			</div>

			<!-- start: search & user box -->
			<div class="header-right">
				<span class="separator"></span>

				<div id="userbox" class="userbox">
					<a href="#" data-toggle="dropdown">
						<figure class="profile-picture">
							<img src=" {{asset('storage/app/public/profile/'.Auth::user()->icon)}}" alt="{{ ucfirst(Auth::user()->name)}}" class="img-circle"
							 data-lock-picture="admin/assets/images/!logged-user.jpg" />
						</figure>
						<div class="profile-info" data-lock-name="John Doe" data-lock-email="{{ ucfirst(Auth::user()->email)}}">
							{{-- <span class="name">{{ ucfirst(Auth::user()->person_name)}}</span> --}}
						</div>

						<i class="fas custom-caret"></i>
					</a>

					<x-admin.menubar />
				</div>
			</div>
			<!-- end: search & user box -->
		</header>
		<!-- end: header -->

		<div class="inner-wrapper">
			<!-- start: sidebar -->
			<aside id="sidebar-left" class="sidebar-left">

				<div class="sidebar-header">
					<div class="sidebar-title">
						Navigation
					</div>
					<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
						<i class="fas fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>

				<div class="nano">
					<div class="nano-content">
						<nav id="menu" class="nav-main" role="navigation">
							<ul class="nav nav-main">
								<li class="nav">
									<a href="{{ route('admin.index') }}">
													<i class="fa fa-home" aria-hidden="true"></i>
													<span>{{ 'Dashboard'}}</span>
												</a>
								</li>

								@foreach(Menu::getAllParentMenus() as $menu)
								<li class="nav-parent">
									<a href="{{ $menu->url != '#' ? route($menu->url) : '#'}}">
											<i class="{{$menu->icon_class}}" 
												@if(Menu::getAllSubMenus())
												aria-hidden="true"
												@endif
											></i>
											<span>{{ $menu->name }}</span>
										</a> @php $hasChildMenu = false; 
@endphp @foreach(Menu::getAllSubMenus() as $sub_menu) @if($sub_menu->parent_id
									== $menu->id) @if(!$hasChildMenu)
									<ul class="nav nav-children">
										@php $hasChildMenu = true; 
@endphp @endif
										<li>
											<a href="{{ $sub_menu->url != '#' ? route($sub_menu->url) : '#'}}">
														{{ $sub_menu->name }}
													</a>
										</li>
										@endif @endforeach @if($hasChildMenu)
									</ul>
									@endif
								</li>
								@endforeach

							</ul>
						</nav>

						<hr class="separator" />

					</div>

				</div>

			</aside>
			<!-- end: sidebar -->

			<section role="main" class="content-body">
				<header class="page-header">
					<h2>@yield('title')</h2>
				</header>
				<!-- start: page -->


				@yield('content')

				<!-- end: page -->
			</section>
		</div>

	</section>

	<!-- Vendor -->
	<script src="{{ asset('admin/assets/vendor/jquery/jquery.js') }}"></script>
	<script src="{{ asset('admin/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
	<script src="{{ asset('admin/assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
	<script src="{{ asset('admin/assets/vendor/nanoscroller/nanoscroller.js') }}"></script>
	<script src="{{ asset('admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('admin/assets/vendor/magnific-popup/magnific-popup.js') }}"></script>
	<script src="{{ asset('admin/assets/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>
	<script src="{{ asset('admin/assets/vendor/pnotify/pnotify.custom.js') }}"></script>
	<script src="{{ asset('admin/assets/vendor/modernizr/modernizr.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	


	<script type="text/javascript">
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	</script>

	@yield('scripts')


	<!-- Theme Base, Components and Settings -->
	<script src="{{ asset('admin/assets/javascripts/theme.js') }}"></script>


	<!-- Theme Initialization Files -->
	<script src="{{ asset('admin/assets/javascripts/theme.init.js') }}"></script>

	<!-- Theme Custom -->
	<script src="{{ asset('admin/assets/javascripts/theme.custom.js') }}"></script>
	@if(Session::has('success') || Session::has('error'))

	<script>
		$( document ).ready(function() {



			function notify(message, type, title = type){
				new PNotify({
					title: title.toUpperCase(),
					text: message,
					type: type,
				});
			}
			
			var message = '{{Session::get(Session::has('success') ? 'success' : 'error')}}';
			var type = '{{ Session::has('success') ? 'success' : 'danger'}}';
			notify(message, type);
		});


	</script>
	@endif
	<script>
				function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
		
        if (charCode!=46 &&charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
		</script>
</body>

</html>
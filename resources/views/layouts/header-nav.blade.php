<nav class="navbar header-navbar pcoded-header">
	<div class="navbar-wrapper">
		<div class="navbar-logo">
			<a href="{{ route('home') }}">
				<img class="img-fluid" src="{{ asset('files/logo.svg') }}" style="width: 60%" alt="Gamji group Logo" />
				{{-- <h2 class="navbar-brand text-center">GAMJI</h2> --}}
			</a>
			<a class="mobile-menu" id="mobile-collapse" href="#!">
				<i class="feather icon-menu icon-toggle-right"></i>
			</a>
			<a class="mobile-options waves-effect waves-light">
				<i class="feather icon-more-horizontal"></i>
			</a>
		</div>
		<div class="navbar-container container-fluid">
			<ul class="nav-left">
				<li>
					<a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
						<i class="full-screen feather icon-maximize"></i>
					</a>
				</li>
			</ul>
			<ul class="nav-right">
				<li class="user-profile header-notification">
					<div class="dropdown-primary dropdown">
						<div class="dropdown-toggle" data-toggle="dropdown">
							<img src="{{ asset('files/assets/images/avatar-4.jpg') }}" class="img-radius" alt="User-Profile-Image">
							<span>{{ Auth::user()->name }}</span>
							<i class="feather icon-chevron-down"></i>
						</div>
						<ul class="show-notification profile-notification dropdown-menu"
							data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
							<li>
								<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
									<i class="feather icon-log-out"></i>
									Logout
								</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
									@csrf
								</form>
							</li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>
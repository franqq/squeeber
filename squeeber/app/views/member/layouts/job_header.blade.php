@include('member.layouts.head')
@include('member.layouts.responsive_menu_header')
					<ul class="normal-menu">
						<li><a href="{{URL::route('member-home')}}">Home</a></li>
						<li><a href="{{URL::route('notices-get')}}">Stories</a></li>
						<li><a href="{{URL::route('events-get')}}">Events</a></li>
						<li><a href="{{URL::route('offers-get')}}">Classifieds</a></li>
						<li class="current" ><a href="{{URL::route('jobs-get')}}">Jobs</a></li>
						<li><a href="{{URL::route('newcollege-get')}}">Settings</a></li>
						<li>
						@include('member.layouts.search_box')
					</ul>
@include('member.layouts.phone_menu_header')
@include('guest.layouts.location')
@yield('content')
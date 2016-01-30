@if(Auth::user())
					@include('member.layouts.post_head')
					@include('member.layouts.responsive_menu_header')
					<ul class="normal-menu">
						<li><a href="{{URL::route('member-home')}}">Home</a></li>
						<li><a href="{{URL::route('events-get')}}">Events</a></li>
						<li><a href="{{URL::route('offers-get')}}">Classifieds</a></li>
						<li><a href="{{URL::route('jobs-get')}}">Jobs</a></li>
						<li><a href="{{URL::route('newcollege-get')}}">College</a></li>
						<li>
						@include('member.layouts.search_box')
					</li>
					</ul>
					@include('member.layouts.phone_menu_header')
@else
					@include('guest.layouts.post_head')
					@include('guest.layouts.responsive_menu_header')
					<ul class="normal-menu">
						<li><a href="{{URL::route('home')}}">Home</a></li>
						<li><a href="{{URL::route('events-get')}}">Events</a></li>
						<li><a href="{{URL::route('offers-get')}}">Classifieds</a></li>
						<li><a href="{{URL::route('jobs-get')}}">Jobs</a></li>
						<li>
						@include('guest.layouts.search_box')
					</li>
					</ul>
					@include('guest.layouts.phone_menu_header')
@endif

<div style="margin:0;">
<p class="change-college">
		<a><strong>{{'@'.$college->alias}}, {{$mycampus->name}}</strong></a>
		<a href="{{URL::route('changecampus-get')}}">Change
		{{HTML::image('images/change-college.png','>>')}}</a>
</p>
</div>
@yield('content')

@include('guest.layouts.footer')

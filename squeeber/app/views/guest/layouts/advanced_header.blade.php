@include('member.layouts.post_head')
<body id="page1" onLoad="new ElementMaxHeight();">
<div class="tail-bottom">
	<div id="main" class="zerogrid">
<!-- header -->
		<header>
			<div class="nav-box">
				<nav>
<ul class="normal-menu">
	@if(Auth::user())
	
	<li><a href="{{URL::route('member-home')}}">Home</a></li>
	@else
	
	<li><a href="{{URL::route('home')}}">Home</a></li>
	@endif	
	<li><a href="{{URL::route('about-get')}}">About</a></li>
	<li><a href="{{URL::route('terms-get')}}">Terms</a></li>
	<li><a href="{{URL::route('privacy-get')}}">Privacy</a></li>
	<li><a href="{{URL::route('help-get')}}">Help</a></li>			
</ul>
</header>




@yield('content')

@include('guest.layouts.footer')

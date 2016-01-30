<!DOCTYPE html>
<html lang="en">
<head>
<title>Squeeber | Colleges News, Gossip, Notices, Events, and Job Notifications in {{$countryname}}</title>
<meta name="description" content="Get all the notices/news, upcoming events, careers, jobs and internship information and classifieds sales amongst students within your college and other colleges in around colleges in {{$countryname}} and around the globe. Put a notice anytime for free to be viewed by your colleagues at school...">
<meta name="keywords" content="squeeber {{$countryname}}, campuses in {{$countryname}}, colleges in {{$countryname}}, college notices,college news in {{$countryname}},college gossip in ,university in {{$countryname}}, best colleges in {{$countryname}}">
<meta name="author" content="squeeber.com - Your college notice board">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

{{HTML::style('css/reset.css')}}
{{HTML::style('css/layout.css')}}
{{HTML::style('css/style.css')}}
{{HTML::style('css/zerogrid.css')}}
{{HTML::style('css/responsive.css')}}

{{HTML::script('js/maxheight.js')}}
{{HTML::script('js/jquery-1.4.2.min.js')}}
{{HTML::script('js/script.js')}}
{{HTML::script('js/css3-mediaqueries.js')}}
{{HTML::script('http://code.jquery.com/jquery-1.10.1.min.js')}}

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-58149652-1', 'auto');
  ga('send', 'pageview');

</script>

</head>

<body id="page1" onLoad="new ElementMaxHeight();">
<div class="tail-bottom">
	<div id="main" class="zerogrid">
<!-- header -->
		<header>
			<div class="nav-box">
				<nav>
<ul class="normal-menu">
	@if(Auth::user())
	<ul class="fright">
		<li><a href="{{URL::route('account-logout')}}">{{HTML::image('images/logout.png','logout')}}</a><div id="desc">Logout</div></li>
	</ul>
	<li><a href="{{URL::route('member-home')}}">Home</a></li>
	@else
	<ul class="fright">
		<li><a href="{{URL::route('signup-get')}}">{{HTML::image('images/user.png')}}</a><div id="desc">Sign Up</div></li>
	</ul>
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

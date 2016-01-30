<!DOCTYPE html>
<html lang="en">
<head>
<title>Squeeber Classifieds | College Classifieds (Buy and Sell stuff) within {{$college->name}} ({{$college->alias}}, {{$mycampus->name}} campus</title>
<meta name="description" content="Get all the notices, classifieds, sales, best bargains and offers notification and any important notifications within your college. Put a notice anytime and sell your old items for free to be viewed by your colleagues at school...">
<meta name="keywords" content="squeeber, classifieds website, {{$college->name}} ({{$college->alias}}, {{$mycampus->name}} campus classifieds, buy sell within {{$college->name}} ({{$college->alias}}, {{$mycampus->name}} campus, campus sales, sales notices,university sales">
<meta name="author" content="squeeber.com - Your daily informer">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

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
{{HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js')}}
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-58149652-1', 'auto');
  ga('send', 'pageview');

</script>

</head>

@include('guest.layouts.responsive_menu_header')
					<ul class="normal-menu">
						<li><a href="{{URL::route('home')}}">Home</a></li>
						<li><a href="{{URL::route('events-get')}}">Events</a></li>
						<li class="current" ><a href="{{URL::route('offers-get')}}">Classifieds</a></li>
						<li><a href="{{URL::route('jobs-get')}}">Jobs</a></li>
						<li>
						@include('guest.layouts.search_box')
					</li>
					</ul>
@include('guest.layouts.phone_menu_header')
@include('guest.layouts.location')
@yield('content')

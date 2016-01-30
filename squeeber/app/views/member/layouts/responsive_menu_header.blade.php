<body id="page1" onLoad="new ElementMaxHeight();">
<div class="tail-bottom">
	<div id="main" class="zerogrid">
<!-- header -->
		<header>
			<div class="nav-box">
				<nav>
					<ul class="fright">
						<li><a style="font-size:small;" href="{{URL::route('member-home')}}">{{HTML::image('images/home.png','home')}}<div id="desc">Home</div></a></li>
						<li><a style="font-size:small;" href="{{URL::route('account-logout')}}">{{HTML::image('images/logout.png','logout')}}<div id="desc">Logout</div></a></li>
						<li><a style="font-size:small;" href="{{URL::route('member-post-get')}}">{{HTML::image('images/post.png','post')}}<div id="desc">Post</div></a></li>
					</ul>
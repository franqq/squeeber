<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
*/

	//load advanced squeeb page	
	Route::get('/advanced_squeeb',array(
		'as' => 'advanced_squeeb-get',
		'uses' => 'NavigationController@getAdvencedSqueebPage'
	));
	
	//load advanced squeeb page	
	Route::get('/advanced_squeeb_post',array(
		'as' => 'advanced_squeeb_post-get',
		'uses' => 'NavigationController@getAdvancedSqueebPostPage'
	));

	//load help page	
	Route::get('/help',array(
		'as' => 'help-get',
		'uses' => 'NavigationController@getHelpPage'
	));
	

	//load terms page	
	Route::get('/privacy',array(
		'as' => 'privacy-get',
		'uses' => 'NavigationController@getPrivacyPage'
	));

	//load terms page	
	Route::get('/terms',array(
		'as' => 'terms-get',
		'uses' => 'NavigationController@getTermsPage'
	));

	//load aboutpage	
	Route::get('/about',array(
		'as' => 'about-get',
		'uses' => 'NavigationController@getAboutPage'
	));
	//load squeeb	
	Route::get('/squeeb/{type}/{id}',array(
		'as' => 'squeeb-get',
		'uses' => 'ClicksController@loadSqueeb'
	));
	//load notice	
	Route::get('/notice/{id}',array(
		'as' => 'notice-get',
		'uses' => 'ClicksController@loadNotice'
	));
	
	//load job	
	Route::get('/job/{id}',array(
		'as' => 'job-get',
		'uses' => 'ClicksController@loadJob'
	));
	//load offer	
	Route::get('/offer/{id}',array(
		'as' => 'offer-get',
		'uses' => 'ClicksController@loadOffer'
	));
	//load event	
	Route::get('/event/{id}',array(
		'as' => 'event-get',
		'uses' => 'ClicksController@loadEvent'
	));
	
	//edit squeeb	
	Route::get('/edit/squeeb',array(
		'as' => 'edit-squeeb',
		'uses' => 'PostController@squeebEdit'
	));
	
	//tweet squeeb	
	Route::get('/tweet/squeeb/{id}',array(
		'as' => 'tweet-squeeb',
		'uses' => 'PostController@tweetSqueeb'
	));
	
	//facebook squeeb	
	Route::get('/facebook/squeeb/{id}',array(
		'as' => 'facebook-squeeb',
		'uses' => 'PostController@facebookSqueeb'
	));
	
	//tweet squeeb	
	Route::get('/report/squeeb/{id}',array(
		'as' => 'report-squeeb',
		'uses' => 'PostController@reportSqueeb'
	));
	
	//other pages gets
	Route::get('/notices',array(
		'as' => 'notices-get',
		'uses' => 'NavigationController@getNoticesPage'
	));
	
	//route campus notices page
	Route::get('notices/{collegename}/{campusname}/{campusid}',array(
		'as' => 'campus-notice-get',
		'uses' => 'NavigationController@getCampusNoticesPage'
	));
	
	Route::get('/more/notices/{lastid}',array(
		'as' => 'more-notices-get',
		'uses' => 'NavigationController@getMoreNoticesPage'
	));
	Route::get('/events',array(
		'as' => 'events-get',
		'uses' => 'NavigationController@getEventsPage'
	));
	
	//route to campus events page
	Route::get('events/{collegename}/{campusname}/{campusid}',array(
		'as' => 'campus-events-get',
		'uses' => 'NavigationController@getCampusEventsPage'
	));
	
	//more events
	Route::get('/more/events/{lastid}',array(
		'as' => 'more-events-get',
		'uses' => 'NavigationController@getMoreEventsPage'
	));
	
	Route::get('/offers',array(
		'as' => 'offers-get',
		'uses' => 'NavigationController@getOffersPage'
	));
	
	//route to campus events page
	Route::get('offers/{collegename}/{campusname}/{campusid}',array(
		'as' => 'campus-offers-get',
		'uses' => 'NavigationController@getCampusOffersPage'
	));
	
	Route::get('/more/offers/{lastid}',array(
		'as' => 'more-offers-get',
		'uses' => 'NavigationController@getMoreOffersPage'
	));
	Route::get('/jobs',array(
		'as' => 'jobs-get',
		'uses' => 'NavigationController@getJobsPage'
	));
	
	//route to campus events page
	Route::get('jobs/{collegename}/{campusname}/{campusid}',array(
		'as' => 'campus-jobs-get',
		'uses' => 'NavigationController@getCampusJobsPage'
	));
	
	Route::get('/more/jobs/{lastid}',array(
		'as' => 'more-jobs-get',
		'uses' => 'NavigationController@getMoreJobsPage'
	));
	
	//select your campus	
	Route::get('/selectcountry',array(
		'as' => 'selectcampus-get',
		'uses' => 'GeneralController@getSelectCampusPage'
	));
	
	//change campus	
	Route::get('/changecampus',array(
		'as' => 'changecampus-get',
		'uses' => 'GeneralController@getChangeCampus'
	));
	
	
	//get user country
	Route::get('/colleges/{code}',array(
		'as' => 'selectcountryid',
		'uses' => 'GeneralController@getSelectCountry'
	));
	
	//get user campus
		Route::get('/campus/{id}',array(
			'as' => 'selectcampus',
			'uses' => 'GeneralController@selectCampus'
		));
	
	//password recovery
	Route::get('/forgot',array(
		'as' => 'forgotpassword-get',
		'uses' => 'AccountController@getForgotPassword'
	));
	
	//load the password reset page
	Route::get('/reset/{code}',array(
		'as' => 'reset-get',
		'uses' => 'AccountController@getResetPassword'
	));
	
	
	/*
	* CSRF protection
	* */
	Route::group(array('before' => 'csrf'),function()
	{
		//post get user country
		Route::post('/advanced/post/selectcollege',array(
			'as' => 'advancedselectcollege1-post',
			'uses' => 'AdvancedPostController@postSelectCountry'
		));
		
		//post advanced squeeb page	
		Route::post('/advanced_squeeb',array(
			'as' => 'advanced_squeeb-post',
			'uses' => 'AdvancedPostController@postSelectPackage'
		));
		
		//post advanced squeeb page	
		Route::post('/advanced/squeeb/post',array(
			'as' => 'advanced_squeeb-post-data',
			'uses' => 'AdvancedPostController@postGuestPosts'
		));
		
		//post advanced squeeb page	
		Route::post('/advanced/squeeb/country/post',array(
			'as' => 'advanced_squeeb-post-data-country',
			'uses' => 'AdvancedPostController@postGuestPostsCountry'
		));
		
		//post advanced squeeb page	
		Route::post('/advanced/squeeb/college/post/1',array(
			'as' => 'advanced_squeeb-post-data-college-1',
			'uses' => 'AdvancedPostController@postGuestPostsCollege1'
		));
		
		//post advanced squeeb page	
		Route::post('/advanced/squeeb/college/post/2',array(
			'as' => 'advanced_squeeb-post-data-college-2',
			'uses' => 'AdvancedPostController@postGuestPostsCollege2'
		));
		
		//post advanced squeeb page	activate
		Route::post('/advanced/squeeb/post/activate',array(
			'as' => 'advanced_squeeb-post-data-activate',
			'uses' => 'AdvancedPostController@postSqueebActivate'
		));
		
		//post activate squeeb
		Route::post('/squeeb/activate',array(
			'as' => 'squeeb_activate-post',
			'uses' => 'PostController@postSqueebActivate'
		));
		
		
		//password recovery
		Route::post('/forgot',array(
			'as' => 'forgotpassword-post',
			'uses' => 'AccountController@postForgotPassword'
		));
		
		//password recovery
		Route::post('/reset',array(
			'as' => 'resetpassword-post',
			'uses' => 'AccountController@postResetPassword'
		));
		
	});
	


/*
 * unauthenticated group
 */
Route::group(array('before' => 'guest'),function()
{
	//route to the home page
	Route::get('/',array(
		'as' => 'home',
		'uses' => 'GuestController@getHomePage'
	));
	
	//route to get the campus home page
	Route::get('{countryname}/{collegename}/{campusname}/{campusid}',array(
		'as' => 'campus-home',
		'uses' => 'GuestController@getCampusHomePage'
	));
	
	//route to more homesqueeb
	Route::get('more/squeebs/{lastid}',array(
		'as' => 'more-home-squeebs',
		'uses' => 'GuestController@getMoreHomePageSqueeb'
	));
	
	//get signup page
	Route::get('/signup',array(
		'as' => 'signup-get',
		'uses' => 'AccountController@getSignUpPage'
	));
	
	//get route to complete registration page
	Route::get('account/activation/{code}',array(
		'as'		=>		'account-activation-get',
		'uses'		=>		'AccountController@getCompleteActivation'
	));
	
	//get login page
	Route::get('/login',array(
		'as' => 'login-get',
		'uses' => 'AccountController@getLogInPage'
	));
	
	

	
	
	Route::get('post',array(
		'as' => 'post-get',
		'uses' => 'PostController@getPostPage'
	));
	

	
	
	
	/*
	* CSRF protection
	* */
	Route::group(array('before' => 'csrf'),function(){
		
		Route::post('/',array(
		'as' => 'home-post',
		'uses' => 'GuestController@getHomePage'
	));
		
		//member home
		Route::get('/home',array(
			'as' => 'member-home-get',
			'uses' => 'MemberController@getMemberHomePage'
		));
	
		
		//get signup page
		Route::post('/signup',array(
			'as' => 'signup-post',
			'uses' => 'AccountController@postSignUp'
		));
		
		
		//post route to login user
		Route::post('/login',array(
			'as' => 'login-post',
			'uses' => 'AccountController@postLogIn'
		));
		
		//post function to post the squeebs from the guest
		Route::post('/post',array(
			'as' => 'post-post',
			'uses' => 'PostController@postGuestPosts'
		));
		
		
		//post function to update db about posted squeeb photos
		Route::post('/photo/uploaded',array(
			'as' => 'post-success',
			'uses' => 'PostController@postUploadSuccess'
		));
		
		
		
	});
	
});

Route::group(array('before'=>'auth'),function(){
	
	//get route to login user
	Route::get('/logout',array(
		'as'=> 'account-logout',
		'uses'=>'AccountController@logOut'
	));	

	//members home
	Route::get('/home',array(
		'as' => 'member-home',
		'uses' => 'MemberController@getMemberHomePage'
	));
	
	//route to more homesqueeb
	Route::get('member/more/squeeb/{lastid}/{leastview}',array(
		'as' => 'member-more-home',
		'uses' => 'MemberController@getMoreMemberHomePage'
	));
	
	//route to post squeeb
	Route::get('member/post',array(
		'as' => 'member-post-get',
		'uses' => 'PostController@getPostPage'
	));
	
	
		//post new college	
	Route::get('/newcollege',array(
		'as' => 'newcollege-get',
		'uses' => 'CollegeController@getNewCollegePage'
	));
	
	//post new campus	
	Route::get('/newcampus',array(
		'as' => 'newcampus-get',
		'uses' => 'CollegeController@getNewCampusPage'
	));
	
	//post new campus	
	Route::get('/newmaincampus',array(
		'as' => 'newmaincampus-get',
		'uses' => 'CollegeController@getNewMainCampusPage'
	));
	
	
	/*
	* CSRF protection
	* */
	Route::group(array('before' => 'csrf'),function(){
		
		
		//members home
		Route::post('/home',array(
			'as' => 'member-home-post',
			'uses' => 'MemberController@getMemberHomePage'
		));
		
		//post function to post the squeebs
		Route::post('member/post',array(
			'as' => 'member-post-post',
			'uses' => 'PostController@postMemberPosts'
		));
		
		//post new college	
		Route::post('/newcollege',array(
			'as' => 'newcollege-post',
			'uses' => 'CollegeController@postNewCollege'
		));
		
		//post new campus	
		Route::post('/newmaincampus',array(
			'as' => 'newmaincampus-post',
			'uses' => 'CollegeController@postNewMainCampus'
		));
		//post new campus	
		Route::post('/newcampus',array(
			'as' => 'newcampus-post',
			'uses' => 'CollegeController@postNewCampus'
		));
		
		//post new campus	
		Route::post('/newcampus/post',array(
			'as' => 'newcampus-post2',
			'uses' => 'CollegeController@postNewCampus2'
		));
		
		//post new campus	
		Route::post('/load/colleges',array(
			'as' => 'loadcolleges-post',
			'uses' => 'CollegeController@postLoadColleges'
		));
		
	});
	
});

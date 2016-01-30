<?php

class CollegeController extends BaseController {
	
	public function getPostPage()
	{
		return View::make('guest.post');
	}
	
	public function getNewCollegePage()
	{
		$countries = Country::where('id','>',0)->orderBy('name','ASC')->get();
		View::share('countries',$countries);
		return View::make('member.addcollege');
	}
	
	public function postNewCollege()
	{
		//verify the user input and create account
		$validator = Validator::make(Input::all(),array(
				'Country'			=>'required|exists:countrys,id',
				'College_Name'		=>'required|max:200|unique:institutions,name',
				'Alias'				=>'required|max:50',
				'Pic' 				=> 'image|max:3000'
		));
		
		if($validator->fails())
		{
			return Redirect::route('newcollege-get')
			->withErrors($validator)
			->withInput()->with('global','Sorry!! College details were not posted, please retry.');
		}
		else {
			$countryid = Input::get('Country');
			$collegename = Input::get('College_Name');
			$alias = Input::get('Alias');
			$file = Input::file('Pic');
			$photo = null;
			$user_id = Auth::user()->id;	
			
					
			if($file!=null)
			{	 
			 	//photos validation
		        $destinationPath = 'logos';
		        $ext      = $file->guessClientExtension();  // Get real extension according to mime type
		        $fullname = $file->getClientOriginalName(); // Client file name, including the extension of the client
		        $hashname = date('H.i.s').'-'.md5($fullname).'.'.$ext; // Hash processed file name, including the real extension
		        $upload_success = $file->move($destinationPath, $hashname);
				//Set the photo path name to hashname
				$photo = $hashname;
			}
			
			
					
			//save college to the database
			$institution = Institution::create(array(
				'user_id'		=>$user_id,
				'country_id'	=>$countryid,
				'name' 			=>$collegename,
				'alias'			=>$alias,
				'photo'			=>$photo,
			));
			
			if($institution)
			{
				View::share('selectedcountryid',$institution->country_id);
				$countries = Country::where('id','>',0)->get();
				
				View::share('countries',$countries);
				$colleges = Institution::where('id','>',0)->get();
				
				View::share('colleges',$colleges);
				View::share('selectedcollegeid',$institution->id);
				return View::make('member.addmaincampus')->with('global','Success!! College Details saved. Enter Main Campus Details');
			}
			
			return Redirect::route('newcollege-get')
			->withInput()->with('global','Sorry!! College details were not posted, please retry.');
		}
	}
	
	
	
	public function getNewMainCampusPage()
	{
		$countries = Country::where('id','>',0)->orderBy('name','ASC')->get();
		View::share('countries',$countries);
		return View::make('member.addmaincampus');
	}
	
	public function postNewMainCampus()
	{
		//verify the user input and create account
		$validator = Validator::make(Input::all(),array(
				'Country'			=>'required|exists:countrys,id',
				'College'			=>'required|exists:institutions,id',
				'Campus'			=>'required|max:200',
		));
		
		if($validator->fails())
		{
			return Redirect::route('newcampus-get')
			->withErrors($validator)
			->withInput()->with('global','Sorry!! College details were not posted, please retry.');
		}
		else {
			$countryid = Input::get('Country');
			$collegeid = Input::get('College');
			$campus = Input::get('Campus');			
			
			
			
			//save college to the database
			//store the user details
			$branch = Branch::create(array(
				'user_id'			=>Auth::user()->id,
				'country_id'		=>$countryid,
				'institutions_id' 	=>$collegeid,
				'name'			=>$campus,
				
			));
			
			if($branch)
			{
				//load success page
				if(Auth::user()){
				return Redirect::route('member-home')
				->with('global','Congratulations!! Your College has been added successfully.<br/><a href="http://www.squeeber.com/newcampus" >Add another</a>');
				}
				else {
					return Redirect::route('home')
				->with('global','Congratulations!! Your College has been added successfully.<br/><a href="http://www.squeeber.com/newcampus" >Add another</a>');
				}
			}
			
			return Redirect::route('newcampus-get')
			->withInput()->with('global','Sorry!! Campus details were not posted, please retry.');
		}
	}
	
	
	public function getNewCampusPage()
	{
		$countries = Country::where('id','>',0)->get();
		View::share('countries',$countries);
		return View::make('member.addcampus');
	}

	public function postNewCampus()
	{
		//verify the user input and create account
		$validator = Validator::make(Input::all(),array(
				'Country'			=>'required|exists:countrys,id',
		));
		
		if($validator->fails())
		{
			return Redirect::route('newcampus-get')
			->withErrors($validator)
			->withInput()->with('global','Sorry!! College details were not posted, please retry.');
		}
		else {
			$countryid = Input::get('Country');			
			
			//query the database for colleges in that country
			$colleges = Institution::where('country_id','=',$countryid)->get();
			
			if($colleges->count())
			{
				$countries = Country::where('id','>',0)->get();
				View::share('countries',$countries);
				View::share('colleges',$colleges);
				View::share('countryid',$countryid);
				return View::make('member.addcampus2');
			}
			else{
				$countries = Country::where('id','>',0)->get();
				View::share('countries',$countries);
				return Redirect::route('newcampus-get')
				->withInput()->with('global','No Colleges were found in this country!');
			}
						
			return Redirect::route('newcampus-get')
			->withInput()->with('global','Sorry!! Campus details were not posted, please retry.');
		}
	}

	public function postNewCampus2()
	{
		//verify the user input and create account
		$validator = Validator::make(Input::all(),array(
				'College'			=>'required|exists:institutions,id',
				'Campus'			=>'required|max:200',
		));
		
		if($validator->fails())
		{
			return Redirect::route('newcampus-get')
			->withErrors($validator)
			->withInput()->with('global','Sorry!! College details were not posted, please retry.');
		}
		else {
			$collegeid = Input::get('College');
			$campus = Input::get('Campus');			
			
			
			//save college to the database
			//store the user details
			$branch = Branch::create(array(
				'user_id'			=>Auth::user()->id,
				'institutions_id' 	=>$collegeid,
				'name'				=>$campus,
				
			));
			
			if($branch)
			{
				//load success page
				if(Auth::user()){
				return Redirect::route('member-home')
				->with('global','Congratulations!! Your College has been added successfully.<br/><a href="http://www.squeeber.com/newcampus" >Add another</a>');
				}
				else {
					return Redirect::route('home')
				->with('global','Congratulations!! Your College has been added successfully.<br/><a href="http://www.squeeber.com/newcampus" >Add another</a>');
				}
			}
			
			return Redirect::route('newcampus-get')
			->withInput()->with('global','Sorry!! Campus details were not posted, please retry.');
		}
	}
}

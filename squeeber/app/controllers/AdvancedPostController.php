<?php

class AdvancedPostController extends BaseController {
	public function getIPAdress()
	{
			$guest_ip = str_random(60);
			Session::put('my_ip',$guest_ip);
			return $guest_ip;
	}
	
	//function to get and replace urls in text
	private function MakeUrls($str)
	{
		$find=array('`((?:https?|ftp)://\S+[[:alnum:]]/?)`si','`((?<!//)(www\.\S+[[:alnum:]]/?))`si');
		
		$replace=array('<a href="$1" target="_blank">$1</a>','<a href="http://$1"    target="_blank">$1</a>');
		
		return preg_replace($find,$replace,$str);
	}
	
	public function postSelectCountry()
	{
		//verify the user input and create account
		$validator = Validator::make(Input::all(),array(
				'Country'			=>'required',
		));
		
		if($validator->fails())
		{
			return Redirect::route('advanced_squeeb-get')
			->withErrors($validator)
			->withInput()->with('global','Sorry!! College details were not loaded, please retry.');
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
				return View::make('guest.advancedselectcollege');
			}
			else{
				$countries = Country::where('id','>',0)->get();
				View::share('countries',$countries);
				return Redirect::route('advanced_squeeb-get')
				->withInput()->with('global','No Colleges were found in that country!');
			}
						
			return Redirect::route('advanced_squeeb-get')
			->withInput()->with('global','Sorry!! College details were not loaded, please retry.');
		}
	}
	
	
	public function postSelectPackage()
	{
		//verify the user input and create account
		$validator = Validator::make(Input::all(),array(
				'Package'				=>'required',
		));
		if($validator->fails())
		{
			return Redirect::route('advanced_squeeb-get')
			->withInput()->with('global','Please select a package.');
		}
		else{
			$package = Input::get('Package');
			
			View::share('package',$package);
			
			//check for the world package
			if($package == 'pkg1')
			{
				$countries = Country::all();
				View::share('countries',$countries);
				$obj = new BaseController;
				
				$countryid=0;
				$countryname = $obj->getCountryName();
				if($countryname!='NONE')
				{
					$locationcountry = Country::where('name','=',$countryname);
					if($locationcountry->count())
					{
						$countryid = $locationcountry->first()->id;
						$colleges = Institution::where('country_id','=',$countryid)->get();
						View::share('colleges',$colleges);
					}
				}
				
				View::share('countryid',$countryid);
				
				return View::make('guest.advancedselectcollege');
			}
			else if($package == 'pkg2')
			{
				$countries = Country::all();
				View::share('countries',$countries);
				$obj = new BaseController;
				
				$countryid=0;
				$countryname = $obj->getCountryName();
				if($countryname!='NONE')
				{
					$locationcountry = Country::where('name','=',$countryname);
					if($locationcountry->count())
					{
						$countryid = $locationcountry->first()->id;
					}
				}
				
				View::share('countryid',$countryid);
				
				return View::make('guest.advancedpostcountry')->with('msg','Country Squeeb Package');
			}
			if($package == 'pkg3')
			{
				
				return View::make('guest.advancedpost')->with('msg','World Squeeb Package');
			}
		}
	}
	
	
	public function postGuestPosts()
	{
			 	 
		//verify the user input and create account
		$validator = Validator::make(Input::all(),array(
				'Type'				=>'required|in:Notice,Eventsq,Job,Offer',
				'Title'				=>'required|max:40',
				'Description'		=>'required',
				'Name'				=>'required|max:120',
				'Email'				=>'required|email|max:60',
				'Pic' 				=> 'image|max:3000'
		));
		
		if($validator->fails())
		{
			return Redirect::route('advanced_squeeb-get')
			->withErrors($validator)
			->withInput()->with('global','Sorry!! Your Squeeb was not posted, please retry.');
		}
		
		else {
			$type = Input::get('Type');
			$title = Input::get('Title');
			$description = Input::get('Description');
			$description = $this->MakeUrls($description);
			$squeeb = substr(strip_tags($description), 0,300);
			
			
			$name = Input::get('Name');
			$email = Input::get('Email');
			$file = Input::file('Pic');
			$package = Input::get('Package');
			
			if($package == 'pkg3')
				$campuses = Branch::all();
			
			
			//check whether the user with this email existed before
			$user = User::where('email','=',$email);
			
			$firstname = NULL;
			$lastname  = NULL;
			
			//extract the firstname and last name from the name
			if(preg_match('/\s/',$name))
			{
				$names = explode(" ", $name);
				$firstname = $names[0];
				$lastname = $names[1];
			}
			else {
				$firstname = $name;
			}
			
			
			if($user->count())
				$user=$user->orderBy('id','DESC')->first();
			else {
				//store the user details
				$user = User::create(array(
					'email'		=>$email,
					'firstname' =>$firstname,
					'lastname'	=>$lastname,
				));
			}
			
			
			//get the model name 
			$model = $type;
			$result = $this->postUploadPhoto($type, $file);
			
			$the_squeeb_array = array();
			
			foreach ($campuses as $campus) {
				$the_squeeb = Squeeb::create(array(
					'model' 		=> $model,
					'views' 		=> 0,
					'branch_id'		=> $campus->id,
					'create_day'    =>date("Y-m-d"),
				));
				
				array_push($the_squeeb_array,$the_squeeb->id);
				
				//create the post details
				$squeeb_id = 0;
				$squeeb_id=$this->createSqueeb($model,$the_squeeb->id,$user->id, $title, $description, $squeeb);
				
				//finally post the squeebe photo
				if($squeeb_id)
				{
					
					
					if($result!=FALSE)
					{
					 	//photos validation
					 	$modelname = $type;
						$tablename = lcfirst($modelname).'s';
						$modelphoto = $modelname.'Photo';
						$savesuccess = $modelphoto::create(array(
						$tablename.'_id'=>$squeeb_id,
						'name'=>$result
						));
					}
				
				}		
				
			}
			
			
			
			if($user && $the_squeeb)
			{
				
				
				if($squeeb_id)
				{
					$squeeb = Squeeb::where('id','=',$the_squeeb->id)->first();
					View::share('squeeb',$squeeb);
					view::share('model',$type);
					$the_squeeb_array = implode(",",$the_squeeb_array);
					View::share('the_squeeb_array',$the_squeeb_array);
					return View::make('guest.advanced_squeeb_preview');
				}
			}
			
		}
		return Redirect::route('advanced_squeeb-get')
			->with('global','Some Error Occured, Please try again');
	}

	public function postGuestPostsCountry()
	{
			 	 
		//verify the user input and create account
		$validator = Validator::make(Input::all(),array(
				'Type'				=>'required|in:Notice,Eventsq,Job,Offer',
				'Title'				=>'required|max:40',
				'Description'		=>'required',
				'Name'				=>'required|max:120',
				'Email'				=>'required|email|max:60',
				'Pic' 				=> 'image|max:3000',
				'Country'			=>'required'
		));
		
		if($validator->fails())
		{
			return Redirect::route('advanced_squeeb-get')
			->withErrors($validator)
			->withInput()->with('global','Sorry!! Your Squeeb was not posted, please retry.');
		}
		
		else {
			$type = Input::get('Type');
			$title = Input::get('Title');
			$description = Input::get('Description');
			$description = $this->MakeUrls($description);
			$squeeb = substr(strip_tags($description), 0,300);
			
			
			$name = Input::get('Name');
			$email = Input::get('Email');
			$file = Input::file('Pic');
			$package = Input::get('Package');
			$countryid = Input::get('Country');
			
			$campuses = Branch::whereHas('Institution',
				function($query) use($countryid) {
					$query->where('country_id','=',$countryid);
				}
			)->select('id')->get();
			
			
			
			//check whether the user with this email existed before
			$user = User::where('email','=',$email);
			
			$firstname = NULL;
			$lastname  = NULL;
			
			//extract the firstname and last name from the name
			if(preg_match('/\s/',$name))
			{
				$names = explode(" ", $name);
				$firstname = $names[0];
				$lastname = $names[1];
			}
			else {
				$firstname = $name;
			}
			
			
			if($user->count())
				$user=$user->orderBy('id','DESC')->first();
			else {
				//store the user details
				$user = User::create(array(
					'email'		=>$email,
					'firstname' =>$firstname,
					'lastname'	=>$lastname,
				));
			}
			
			
			//get the model name 
			$model = $type;
			$result = $this->postUploadPhoto($type, $file);
			
			$the_squeeb_array = array();
			
			foreach ($campuses as $campus) {
				$the_squeeb = Squeeb::create(array(
					'model' 		=> $model,
					'views' 		=> 0,
					'branch_id'		=> $campus->id,
					'create_day'    =>date("Y-m-d"),
				));
				
				array_push($the_squeeb_array,$the_squeeb->id);
				
				//create the post details
				$squeeb_id = 0;
				$squeeb_id=$this->createSqueeb($model,$the_squeeb->id,$user->id, $title, $description, $squeeb);
				
				//finally post the squeebe photo
				if($squeeb_id)
				{
					
					
					if($result!=FALSE)
					{
					 	//photos validation
					 	$modelname = $type;
						$tablename = lcfirst($modelname).'s';
						$modelphoto = $modelname.'Photo';
						$savesuccess = $modelphoto::create(array(
						$tablename.'_id'=>$squeeb_id,
						'name'=>$result
						));
					}
				
				}		
				
			}
			
			
			
			if($user && $the_squeeb)
			{
				
				
				if($squeeb_id)
				{
					$squeeb = Squeeb::where('id','=',$the_squeeb->id)->first();
					View::share('squeeb',$squeeb);
					view::share('model',$type);
					$the_squeeb_array = implode(",",$the_squeeb_array);
					View::share('the_squeeb_array',$the_squeeb_array);
					return View::make('guest.advanced_squeeb_preview');
				}
			}
			
		}
		return Redirect::route('advanced_squeeb-get')
			->with('global','Some Error Occured, Please try again');
	}
	
	public function postGuestPostsCollege1()
	{
		//verify the user input and create account
		$validator = Validator::make(Input::all(),array(
				'College'			=>'required',
		));
		
		if($validator->fails())
		{
			return Redirect::route('advanced_squeeb-get')
			->withErrors($validator)
			->withInput()->with('global','Sorry!! College details were not loaded, please retry.');
		}
		else {
			$collegeid = Input::get('College');
			View::share('collegeid',$collegeid);
			return View::make('guest.advancedpostcollege')->with('msg','College Squeeb Package');
		}
	}

	public function postGuestPostsCollege2()
	{
			 	 
		//verify the user input and create account
		$validator = Validator::make(Input::all(),array(
				'Type'				=>'required|in:Notice,Eventsq,Job,Offer',
				'Title'				=>'required|max:40',
				'Description'		=>'required',
				'Name'				=>'required|max:120',
				'Email'				=>'required|email|max:60',
				'Pic' 				=> 'image|max:3000',
				'College'			=>'required'
		));
		
		if($validator->fails())
		{
			return Redirect::route('advanced_squeeb-get')
			->withErrors($validator)
			->withInput()->with('global','Sorry!! Your Squeeb was not posted, please retry.');
		}
		
		else {
			$type = Input::get('Type');
			$title = Input::get('Title');
			$description = Input::get('Description');
			$description = $this->MakeUrls($description);
			$squeeb = substr(strip_tags($description), 0,300);
			
			
			$name = Input::get('Name');
			$email = Input::get('Email');
			$file = Input::file('Pic');
			$package = Input::get('Package');
			$collegeid = Input::get('College');
			
			$campuses = Branch::where('institutions_id','=',$collegeid)->select('id')->get();
			
			
			
			//check whether the user with this email existed before
			$user = User::where('email','=',$email);
			
			$firstname = NULL;
			$lastname  = NULL;
			
			//extract the firstname and last name from the name
			if(preg_match('/\s/',$name))
			{
				$names = explode(" ", $name);
				$firstname = $names[0];
				$lastname = $names[1];
			}
			else {
				$firstname = $name;
			}
			
			
			if($user->count())
				$user=$user->orderBy('id','DESC')->first();
			else {
				//store the user details
				$user = User::create(array(
					'email'		=>$email,
					'firstname' =>$firstname,
					'lastname'	=>$lastname,
				));
			}
			
			
			//get the model name 
			$model = $type;
			$result = $this->postUploadPhoto($type, $file);
			
			$the_squeeb_array = array();
			
			foreach ($campuses as $campus) {
				$the_squeeb = Squeeb::create(array(
					'model' 		=> $model,
					'views' 		=> 0,
					'branch_id'		=> $campus->id,
					'create_day'    =>date("Y-m-d"),
				));
				
				array_push($the_squeeb_array,$the_squeeb->id);
				
				//create the post details
				$squeeb_id = 0;
				$squeeb_id=$this->createSqueeb($model,$the_squeeb->id,$user->id, $title, $description, $squeeb);
				
				//finally post the squeebe photo
				if($squeeb_id)
				{
					
					
					if($result!=FALSE)
					{
					 	//photos validation
					 	$modelname = $type;
						$tablename = lcfirst($modelname).'s';
						$modelphoto = $modelname.'Photo';
						$savesuccess = $modelphoto::create(array(
						$tablename.'_id'=>$squeeb_id,
						'name'=>$result
						));
					}
				
				}		
				
			}
			
			
			
			if($user && $the_squeeb)
			{
				
				
				if($squeeb_id)
				{
					$squeeb = Squeeb::where('id','=',$the_squeeb->id)->first();
					View::share('squeeb',$squeeb);
					view::share('model',$type);
					$the_squeeb_array = implode(",",$the_squeeb_array);
					View::share('the_squeeb_array',$the_squeeb_array);
					return View::make('guest.advanced_squeeb_preview');
				}
			}
			
		}
		return Redirect::route('advanced_squeeb-get')
			->with('global','Some Error Occured, Please try again');
	}

	public function postMemberPosts()
	{
			 	 
		//verify the user input and create account
		$validator = Validator::make(Input::all(),array(
				'Typem'				=>'required|in:Notice,Eventsq,Job,Offer',
				'Title'				=>'required|max:200',
				'Description'		=>'required',
				'Pic' 				=> 'image|max:3000'
		));
		if($validator->fails())
		{
			return Redirect::route('member-post-get')
			->withErrors($validator)
			->withInput()->with('global','Sorry!! Your Squeeb was not posted, please retry.');
		}
		else {
			$type = Input::get('Typem');
			$title = Input::get('Title');
			$description = Input::get('Description');
			$description = $this->MakeUrls($description);
			$squeeb = substr(strip_tags($description), 0,300);
			
			$campusid = $this->getDevice();
			
			$file = Input::file('Pic');
			
			//get the current user id
			$user_id = Auth::user()->id;
			
			
			
			//get the model name 
			$model = $type;
												
			$the_squeeb = Squeeb::create(array(
					'model' 		=> $model,
					'views' 		=> 0,
					'branch_id'		=>$campusid,
					'create_day'    =>date("Y-m-d"),
				));
			
			
			if($the_squeeb)
			{
				//create the post details
				$squeeb_id = 0;
				
				
				
				
				$squeeb_id=$this->createSqueeb($model,$the_squeeb->id,$user_id, $title, $description, $squeeb);
				
				//finally post the squeebe photo
				if($squeeb_id)
				{
					$this->postUploadPhoto($type, $squeeb_id, $file);
				}		
				
				
				if($squeeb_id)
				{
					$squeeb = Squeeb::where('id','=',$the_squeeb->id)->first();
					View::share('squeeb',$squeeb);
					view::share('model',$type);
					return View::make('member.squeeb_preview');
				}
			}
			
		}
		return Redirect::route('member-post-get')
			->with('global','Some Error Occured, Please try again');
	}
	
	public function createSqueeb($modelname,$squeebid,$userid,$title,$description,$squeeb)
	{		
		//store the user details
		$squeeb_create = $modelname::create(array(
			'users_id'			=>$userid,
			'squeebs_id'		=>$squeebid,
			'title'				=>$title,
			'description'		=>$description,
			'squeeb'			=>$squeeb,
		));
		
		if($squeeb_create)
		{
			return $squeeb_create->id;
		}
		else {
			return 0;
		}
	}
	

	public function postUploadPhoto($modelname,$file)
	{		if($file)
			{	 
			 	//photos validation
				$tablename = lcfirst($modelname).'s';
		        $destinationPath = 'squeeb_photos';
		        $ext      = $file->guessClientExtension();  // Get real extension according to mime type
		        $fullname = $file->getClientOriginalName(); // Client file name, including the extension of the client
		        $hashname = date('H.i.s').'-'.$tablename.'-'.md5($fullname).'.'.$ext; // Hash processed file name, including the real extension
		        $upload_success = $file->move($destinationPath, $hashname);
				
				
				return $hashname;
			}
			
			return FALSE;
     
	}
		
	public function squeebEdit()
	{
		
			return Redirect::to(URL::previous());
	}
	
	public function postSqueebActivate()
	{
		$the_squib_array = Input::get('The_Squib_Array');
		$the_squib_array = explode(",", $the_squib_array);
		
		$squibsave = FALSE;
		
		foreach ($the_squib_array as $the_squib) {
			$squeeb = Squeeb::where('id','=',$the_squib);
			if($squeeb->count())
			{
				$squeeb = $squeeb->first();
				$squeeb->active = TRUE;
				$squibsave = $squeeb->Save();
			}
		}
		
		
		if($squibsave)
		{
			
			
				//success
				if(Auth::user())
				return Redirect::route('member-home')->with('global','Congratulations! Your Squeeb is active<br/><a href="http://www.squeeber.com/member/post">Post Another</a>');
				return Redirect::route('home')->with('global','Congratulations! Your Squeeb is active<br/><a href="http://www.squeeber.com/post">Post Another</a>');
			
		}
		
		if(Auth::user())
		return Redirect::route('advanced_squeeb-get')
			->with('global','Some Error Occured, Please try again');
			
		return Redirect::route('advanced_squeeb-get')
			->with('global','Some Error Occured, Please try again');
	}
	
	//facebook and twitter shares
	public function tweetSqueeb($id)
	{
		//update the number of shared times
		$squeeb = Squeeb::where('id','=',$id);
		if($squeeb->count())
		{
			$squeeb = $squeeb->first();
			$squeeb->shares = $squeeb->shares + 1;
			if($squeeb->save())
			{
				$twitterlink = 'https://twitter.com/share?text=Check%20out%20on%20squeeber.com%20&url=';
				$currentlink = URL::current();
				$link = $twitterlink.$currentlink;
				return Redirect::away($link);
			}
		}
	}
	public function facebookSqueeb($id)
	{
		//update the number of shared times
		$squeeb = Squeeb::where('id','=',$id);
		if($squeeb->count())
		{
			$squeeb = $squeeb->first();
			$squeeb->shares = $squeeb->shares + 1;
			if($squeeb->save()){
				return Redirect::away('https://www.facebook.com/sharer.php?u=http://www.squeeber.com/squeeb/'.$squeeb->model.'/'.$squeeb->id);
			}
		}
	}
	public function reportSqueeb($id)
	{
		//update the number of reported times
		$squeeb = Squeeb::where('id','=',$id);
		if($squeeb->count())
		{
			$squeeb = $squeeb->first();
			$squeeb->reports = $squeeb->reports + 1;
			if($squeeb->save()){
				return Redirect::back()->with('global','Your Complaint has been received. This squeeb will be reviewed in a short while and necessary actions taken.');
			}
		}
	}
}

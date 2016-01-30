<?php

class PostController extends BaseController {
	
	//function to get and replace urls in text
	private function MakeUrls($str)
	{
		$find=array('`((?:https?|ftp)://\S+[[:alnum:]]/?)`si','`((?<!//)(www\.\S+[[:alnum:]]/?))`si');
		
		$replace=array('<a href="$1" target="_blank">$1</a>','<a href="http://$1"    target="_blank">$1</a>');
		
		return preg_replace($find,$replace,$str);
	}
	
	public function getPostPage()
	{
		$obj = new BaseController;
			$campusid = $this->getDevice();
			if($campusid==0){
				$countryname = $obj->getCountryName();
				if($countryname=='NONE')
				{
					return Redirect::route('selectcampus-get');
				}
				else {
					//check whether the country name exists inthe db
					$locationcountry = Country::where('name','=',$countryname);
					if($locationcountry->count())
					{
						$locationcountrycode = $locationcountry->first()->code;
						$locationcountrycode = strtolower($locationcountrycode);
						return Redirect::route('selectcountryid',$locationcountrycode);
					}
					else{
						return Redirect::route('selectcampus-get');
					}
				}
			}
			
		$college = Institution::whereHas('Branch',function($query) use($campusid){
			$query->where('id','=',$campusid);
		})->first();
		
		View::share('college',$college);
			
		$mycampus = Branch::where('id','=',$campusid)->first();
		View::share('mycampus',$mycampus);
		
		if(Auth::user())
		return View::make('member.post');
		
		return View::make('guest.post');
	}
	
	private function getDevice()
	{
		/*require_once(app_path().'/includes/ip.codehelper.io.php');
		require_once(app_path().'/includes/php_fast_cache.php');
		
		$_ip = new ip_codehelper();
		$campusid = 0;
		
		$real_client_ip_address = $_ip->getRealIP();
		$visitor_location       = $_ip->getLocation($real_client_ip_address);
		
		$guest_ip   = $visitor_location['IP'];
		$guest_country = $visitor_location['CountryName'];*/
		
		$guest_ip = '0.0.0.0';
		
		//get the ip address of the remote machine
		if(Session::has('my_ip'))
		{
			$guest_ip = Session::get('my_ip');
		}
		else {
			$guest_ip = str_random(60);
			Session::put('my_ip',$guest_ip);
		}
		
		//check if the ip adress is in the devices table
		$device = Device::where('ip','=',$guest_ip);
		
		if($device->count())
		{
			//redirect to the previous page
			$device = $device->first();
			$campusid = $device->branch_id;
			return $campusid;
		}
		else{
			//redirect to country selection page and save it on selection
			return 0;
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
			return Redirect::route('post-get')
			->withErrors($validator)
			->withInput()->with('global','Sorry!! Your Squeeb was not posted, please retry.');
		}
		else {
			$type = Input::get('Type');
			$title = Input::get('Title');
			$description = Input::get('Description');
			$description = $this->MakeUrls($description);
			$squeeb = substr(strip_tags($description), 0,300);
			$campusid = $this->getDevice();
			
			$name = Input::get('Name');
			$email = Input::get('Email');
			$file = Input::file('Pic');
			
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
			
			$the_squeeb = Squeeb::create(array(
					'model' 		=> $model,
					'views' 		=> 0,
					'branch_id'		=> $campusid,
					'create_day'    =>date("Y-m-d"),
				));
			
			
			if($user && $the_squeeb)
			{
				//create the post details
				$squeeb_id = 0;
				$squeeb_id=$this->createSqueeb($model,$the_squeeb->id,$user->id, $title, $description, $squeeb);
				
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
					return View::make('guest.squeeb_preview');
				}
			}
			
		}
		return Redirect::route('post-get')
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
	

	public function postUploadPhoto($modelname,$squeebid,$file)
	{		if($file)
			{	 
			 	//photos validation
				$tablename = lcfirst($modelname).'s';
		        $destinationPath = 'squeeb_photos';
		        $ext      = $file->guessClientExtension();  // Get real extension according to mime type
		        $fullname = $file->getClientOriginalName(); // Client file name, including the extension of the client
		        $hashname = date('H.i.s').'-'.$tablename.'-'.$squeebid.'-'.md5($fullname).'.'.$ext; // Hash processed file name, including the real extension
		        $upload_success = $file->move($destinationPath, $hashname);
				//SAVE TO THE DATABASE
				$modelphoto = $modelname.'Photo';
				
				$savesuccess = $modelphoto::create(array(
				$tablename.'_id'=>$squeebid,
				'name'=>$hashname
				));
			}
     
	}
		
	public function squeebEdit()
	{
		
			return Redirect::to(URL::previous());
	}
	
	public function postSqueebActivate()
	{
		$squeeb_id = Input::get('SqueebID');
		
		$squeeb = Squeeb::where('id','=',$squeeb_id);
		
		if($squeeb->count())
		{
			$squeeb = $squeeb->first();
			$squeeb->active = TRUE;
			if($squeeb->Save())
			{
				//success
				if(Auth::user())
				return Redirect::route('member-home')->with('global','Congratulations! Your Squeeb is active<br/><a href="http://www.squeeber.com/member/post">Post Another</a>');
				return Redirect::route('home')->with('global','Congratulations! Your Squeeb is active<br/><a href="http://www.squeeber.com/post">Post Another</a>');
			}
		}
		
		if(Auth::user())
		return Redirect::route('member-post-get')
			->with('global','Some Error Occured, Please try again');
			
		return Redirect::route('post-get')
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

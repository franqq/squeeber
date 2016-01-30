<?php

class GuestController extends BaseController {
	
	const SQUEEB_LIMIT = 8;
	const TOP_SQUEEB_LIMIT = 5;
	
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
			
	public function getHomePage()
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
			
		
			
		
		$college= Institution::whereHas('Branch',function($query) use($campusid){
			$query->where('id','=',$campusid);
		})->first();
		
		$collegename = $college->name;
		
		$countryname = Country::where('id','=',$college->country_id)->first()->name;
		
		$campusname = Branch::where('id','=',$campusid)->first()->name;
		
		$campusdetails = $countryname.'/'.$collegename.'/'.$campusname.'/'.$campusid;
		
		$campusdetails = strtolower($campusdetails);
		
		$campusdetails = str_replace(' ', '-', $campusdetails);
			
		return Redirect::route('campus-home',$campusdetails);
	}
	
	public function getCampusHomePage($countryx,$collegex,$campusx,$campusid)
	{
		$college= Institution::whereHas('Branch',function($query) use($campusid){
			$query->where('id','=',$campusid);
		})->first();
		
		$collegeid = $college->id;
		
		$countryid = Country::where('id','=',$college->country_id)->first()->id;
		
					
		//get the top squeeb to display
		$newsqueebs = Squeeb::where('active','=',TRUE)->where('branch_id','=',$campusid)->orderBy('id','DESC')->take(self::TOP_SQUEEB_LIMIT)->get();
		View::share('newsqueebs',$newsqueebs);
	
		
		$last_id=0;		
		$more = true;
		
		
		
		$squeebs = Notice::whereHas('Squeeb',function($query) use($campusid)
							{	
							  	$query->where('branch_id','=',$campusid)->where('active','=',TRUE);
							})
							->orwhereHas('Squeeb',function($query)
							{	
							  	$query->where('branch_id','=',0)->where('world','=',TRUE)->where('active','=',TRUE);
							})
							->orwhereHas('Squeeb',function($query) use($countryid)
							{	
								$query->where('branch_id','=',0)->where('country','=',$countryid)->where('active','=',TRUE);
							})
							->orwhereHas('Squeeb',function($query) use($collegeid)
							{	
							  	$query->where('branch_id','=',0)->where('college','=',$collegeid)->where('active','=',TRUE);
							});
		
		$last = $squeebs;
		$squeebs = $squeebs->orderBy('id','DESC')->take(self::SQUEEB_LIMIT)->get();
		if($squeebs->count())
		$last_id = $last->orderBy('id','DESC')->take(self::SQUEEB_LIMIT)->get()->last()->Squeeb()->first()->id;
		
		View::share('last_id',$last_id);
		View::share('squeebs',$squeebs);
		
		//get the top squeeb to display
		$topsqueebs = Squeeb::where('active','=',TRUE)->where('model','=','Notice')->where('branch_id','=',$campusid)->orderBy('views','DESC')->take(self::TOP_SQUEEB_LIMIT)->get();
		View::share('topsqueebs',$topsqueebs);
		
		if($last_id<=0 or $squeebs->count()!=self::SQUEEB_LIMIT)
		{
			$more=false;
		}
		
		$college = Institution::whereHas('Branch',function($query) use($campusid){
			$query->where('id','=',$campusid);
		})->first();
		
		View::share('college',$college);
		
		View::share('more',$more);
		
		$mycampus = Branch::where('id','=',$campusid)->first();
		View::share('mycampus',$mycampus);		
			
		
		return View::make('guest.home');
	}

	//load more
	public function getMoreHomePageSqueeb($lastid)
	{
		$campusid = $this->getDevice();
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
		
		$more = true;
		
		$college= Institution::whereHas('Branch',function($query) use($campusid){
			$query->where('id','=',$campusid);
		})->first();
		
		$collegeid = $college->id;
		
		$countryid = Country::where('id','=',$college->country_id)->first()->id;
		
		//get the top squeeb to display
		$newsqueebs = Squeeb::where('active','=',TRUE)->where('branch_id','=',$campusid)->orderBy('id','DESC')->take(self::TOP_SQUEEB_LIMIT)->get();
		View::share('newsqueebs',$newsqueebs);
		
		
		$squeebs = Notice::whereHas('Squeeb',function($query) use($campusid,$lastid)
							{
							  $query->where('branch_id','=',$campusid)->where('id','<',$lastid)->where('active','=',TRUE);
							})
							->orwhereHas('Squeeb',function($query) use($lastid)
							{
							  $query->where('branch_id','=',0)->where('world','=',TRUE)->where('id','<',$lastid)->where('active','=',TRUE);
							})
							->orwhereHas('Squeeb',function($query) use($lastid,$countryid)
							{
							  $query->where('branch_id','=',0)->where('country','=',$countryid)->where('id','<',$lastid)->where('active','=',TRUE);
							})
							->orwhereHas('Squeeb',function($query) use($lastid,$collegeid)
							{
							  $query->where('branch_id','=',0)->where('college','=',$collegeid)->where('id','<',$lastid)->where('active','=',TRUE);
							});
		
		$last = $squeebs;
		$squeebs = $squeebs->orderBy('id','DESC')->take(self::SQUEEB_LIMIT)->get();
		if($squeebs->count())
		$last_id = $last->orderBy('id','DESC')->take(self::SQUEEB_LIMIT)->get()->last()->Squeeb()->first()->id;
		
		View::share('last_id',$last_id);
		View::share('squeebs',$squeebs);
		
		//get the top squeeb to display
		$topsqueebs = Squeeb::where('active','=',TRUE)->where('model','=','Notice')->where('branch_id','=',$campusid)->orderBy('views','DESC')->take(self::TOP_SQUEEB_LIMIT)->get();
		View::share('topsqueebs',$topsqueebs);
		
		if($lastid<=0 or $squeebs->count()!=self::SQUEEB_LIMIT)
		{
			$more=false;
		}
		
		$college = Institution::whereHas('Branch',function($query) use($campusid){
			$query->where('id','=',$campusid);
		})->first();
		
		View::share('college',$college);
		
		View::share('more',$more);
		
		$mycampus = Branch::where('id','=',$campusid)->first();
		View::share('mycampus',$mycampus);
		
		
		return View::make('guest.home');
	}
	
	
}
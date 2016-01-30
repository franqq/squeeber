<?php

class MemberController extends BaseController {

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
			
	public function getMemberHomePage()
	{
		$campusid = $this->getDevice();
		if($campusid==0)
		return Redirect::route('selectcampus-get');
		//code to load the homepage once the user selects the required details
		$more = true;
		$last = 0;
		$last_id = 0;
		$least_view = 0;
		$least_last_id = 0;
		
		$squeebs = Squeeb::where('branch_id','=',$campusid)->where('active','=',TRUE)->where('model', '!=', 'Notice');
		
		$least = $squeebs;
		
		$squeebs = $squeebs->orderBy('create_day','DESC')->orderBy('views','DESC')->orderBy('id','DESC')->take(self::SQUEEB_LIMIT)->get();
		if($least->count()){
			$last = $squeebs->last();
			$last_id = $last->id;
			$least_view = $last->views;
			//get the oldest item with least views
			$least_last_id = Squeeb::where('branch_id','=',$campusid)->where('active','=',TRUE)->orderBy('views','DESC')->orderBy('id','DESC')->get()->last()->id;
		}
		
		
		
		
		
		if($last_id<=0 or $squeebs->count()!=self::SQUEEB_LIMIT or $last_id==$least_last_id)
		{
			$more=false;
		}
		else {
			View::share('least_view',$least_view);
			View::share('last_id',$last_id);
		}
		
		$college = Institution::whereHas('Branch',function($query) use($campusid){
			$query->where('id','=',$campusid);
		})->first();
		
		View::share('college',$college);

		View::share('squeebs',$squeebs);
		
		View::share('more',$more);
		
		//get the top squeeb to display
		$newsqueebs = Squeeb::where('branch_id','=',$campusid)->where('active','=',TRUE)->orderBy('id','DESC')->take(self::TOP_SQUEEB_LIMIT)->get();
		
		View::share('newsqueebs',$newsqueebs);
		
		$mycampus = Branch::where('id','=',$campusid)->first();
		View::share('mycampus',$mycampus);
		
		return View::make('member.home');
	}

	//load more
	public function getMoreMemberHomePage($lastid,$leastview)
	{
		$campusid = $this->getDevice();
		if($campusid==0)
		return Redirect::route('selectcampus-get');
		
		$more = true;
		
		$squeebs=Squeeb::where('branch_id','=',$campusid)->where('model', '!=', 'Notice')->where('active','=',TRUE)->where(function($squeebs) use($leastview,$lastid){
			$squeebs->where('active','=',TRUE)->where('id','<',$lastid)->where('views','<=',$leastview);
		})->orWhere('views','<',$leastview)->where('model', '!=', 'Notice')->where(function($squeebs) {$squeebs->where('active','=',TRUE);});;
		
		$least = $squeebs;
		
		$squeebs = $squeebs->orderBy('create_day','DESC')->orderBy('views','DESC')->where('branch_id','=',$campusid)->orderBy('id','DESC')->take(self::SQUEEB_LIMIT)->get();	
		
		
		
		$last = $squeebs->last();
		
		$last_id = $last->id;
			
		$least_view = $last->views;
		
		//get the oldest item with least views
		$least_last_id = Squeeb::where('branch_id','=',$campusid)->where('active','=',TRUE)->orderBy('views','DESC')->orderBy('id','DESC')->get()->last()->id;
		
		if($last_id<=0 or $squeebs->count()!=self::SQUEEB_LIMIT or $last_id==$least_last_id)
		{
			$more=false;
		}
		else {
			View::share('least_view',$least_view);
			View::share('last_id',$last_id);
		}
		
		$college = Institution::whereHas('Branch',function($query) use($campusid){
			$query->where('id','=',$campusid);
		})->first();
		
		View::share('college',$college);
		
		View::share('squeebs',$squeebs);
		View::share('more',$more);
		
		//get the top squeeb to display
		$newsqueebs = Squeeb::where('branch_id','=',$campusid)->where('active','=',TRUE)->orderBy('id','DESC')->take(self::TOP_SQUEEB_LIMIT)->get();
		View::share('newsqueebs',$newsqueebs);
		
		$mycampus = Branch::where('id','=',$campusid)->first();
		View::share('mycampus',$mycampus);
		
		return View::make('member.home');
	}

}

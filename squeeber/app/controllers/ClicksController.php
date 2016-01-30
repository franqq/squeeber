<?php
require_once(app_path().'/includes/Mobile_Detect.php');
class ClicksController extends BaseController {

	public function loadNotice($id)
	{
		$squeeb = Notice::where('id','=',$id)->first();
		View::share('squeeb',$squeeb);
		view::share('model','Notice');
		
		//detect device
		$detect = new Mobile_Detect;
		$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
		View::share('deviceType',$deviceType);
		
		//update the squeeb table
		$this->sqFactor($squeeb);
		
		if(Auth::user())
		return View::make('member.squeeb');
		
		return View::make('guest.squeeb');
	}
	public function loadJob($id)
	{
		$squeeb = Job::where('id','=',$id)->first();
		View::share('squeeb',$squeeb);
		view::share('model','Job');
		
		//detect device
		$detect = new Mobile_Detect;
		$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
		View::share('deviceType',$deviceType);
		
		//update the squeeb table
		$this->sqFactor($squeeb);
		
		if(Auth::user())
		return View::make('member.squeeb');
		
		return View::make('guest.squeeb');
	}
	public function loadOffer($id)
	{
		$squeeb = Offer::where('id','=',$id)->first();
		View::share('squeeb',$squeeb);
		view::share('model','Offer');
		
		//detect device
		$detect = new Mobile_Detect;
		$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
		View::share('deviceType',$deviceType);
	
		//update the squeeb table
		$this->sqFactor($squeeb);
		
		
		if(Auth::user())
		return View::make('member.squeeb');
		
		return View::make('guest.squeeb');
	}
	public function loadEvent($id)
	{
		$squeeb = Eventsq::where('id','=',$id)->first();
		View::share('squeeb',$squeeb);
		view::share('model','Event');
		
		//detect device
		$detect = new Mobile_Detect;
		$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
		View::share('deviceType',$deviceType);
		
		//update the squeeb table
		$this->sqFactor($squeeb);
		
		if(Auth::user())
		return View::make('member.squeeb');
		
		return View::make('guest.squeeb');
	}
	public function loadSqueeb($type,$id)
	{
		$squeeb = Squeeb::where('id','=',$id)->first();
		View::share('squeeb',$squeeb);
		view::share('model',$type);
		
		//detect device
		$detect = new Mobile_Detect;
		$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
		View::share('deviceType',$deviceType);
		
		$views = $squeeb->views;
		$squeeb->views = $views + 1;
		$saved = $squeeb->save();
		
		if(Auth::user())
		return View::make('member.home_squeeb');
		
		return View::make('guest.home_squeeb');
	}
	
	private function sqFactor($squeeb)
	{
		//update the squeeb table
		$sqfactor = Squeeb::where('id','=',$squeeb->squeebs_id);
		
		if($sqfactor->count())
		{
			$sqfactor = $sqfactor->first();
			$sqfactor->views = $sqfactor->views + 1;
			$saved = $sqfactor->save();
		}
	}
}

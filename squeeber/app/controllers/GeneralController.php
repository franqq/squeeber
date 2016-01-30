<?php

class GeneralController extends BaseController {
	
	public function getIPAdress()
	{
			$guest_ip = str_random(60);
			Session::put('my_ip',$guest_ip);
			return $guest_ip;
	}

	public function getSelectCampusPage()
	{
		$countries = Country::where('id','>',0)->orderBy('alias','ASC')->get();
		View::share('countries',$countries);
		return View::make('guest.selectcampus');
	}
	
	public function getSelectCountry($code)
	{
			$code = strtoupper($code);
		
			$countryid = Country::where('code','=',$code)->first()->id;		
			
			//get the country name	
			$countryname = Country::where('id','=',$countryid)->first()->name;
			//query the database for colleges in that country
			$colleges = Institution::where('country_id','=',$countryid)->orderBy('name','ASC')->get();
			
			if($colleges->count())
			{
				$countries = Country::where('id','>',0)->get();
				View::share('countries',$countries);
				View::share('colleges',$colleges);
				View::share('countryid',$countryid);
				View::share('countryname',$countryname);
				return View::make('guest.selectcampus1');
			}
			else{
				$countries = Country::where('id','>',0)->get();
				View::share('countries',$countries);
				return Redirect::route('selectcampus-get')
				->withInput()->with('global','No Colleges were found in '.$countryname.'!<br>Please <a href="http://www.squeeber.com/signup">add your college</a> and invite friends');
			}
						
			return Redirect::route('selectcampus-get')
			->withInput()->with('global','Sorry!! Campus details were not loaded, please retry.');
		
	}

	

	public function selectCampus($id)
	{
			
			$campusid = $id;	
			$ipadress = $this->getIPAdress();		
			
			/*store the institutions id alongside the specific ip adress in the devices table
			 * and redirect user to the specific homepage
			 */
			$exists = Device::where('ip','=',$ipadress);
			if($exists->count())
			{
				$device = $exists->first();
				$device->branch_id = $campusid;
				if($device->save())
				{
					if(Auth::user())
						return Redirect::route('member-home');
					else {
						return Redirect::route('home');
					}
				}
			}
			else {
				$devicecreate = Device::create(array(
				'ip'			=>$ipadress,
				'branch_id'		=>$campusid
				));
				
				if($devicecreate)
				{
					if(Auth::user())
						return Redirect::route('member-home');
					else {
						return Redirect::route('home');
					}
				}
			}
			
						
			return Redirect::route('selectcampus-get')
			->withInput()->with('global','Sorry!! Campus details were not loaded, please retry.');
		}
		
		public function getChangeCampus()
		{
			$obj = new BaseController;
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
	
}

<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
	
	public function getCountryName()
	{
			/*Get user ip address*/
			$ip_address=$_SERVER['REMOTE_ADDR'];
			
			/*Get user ip address details with geoplugin.net*/
			$geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip_address;
			$addrDetailsArr = unserialize(file_get_contents($geopluginURL)); 
			
			
			
			/*Get Country name by return array*/
			$country = $addrDetailsArr['geoplugin_countryName'];
			
			
			if(!$country){
			   return 'NONE';
			}
			else {
				return $country;
			}
			
	}

}

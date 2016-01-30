<?php

class HomeController extends BaseController {

	public function printCountryName()
	{
		return geoip_country_name_by_name (www.google.com);
	}
	
}

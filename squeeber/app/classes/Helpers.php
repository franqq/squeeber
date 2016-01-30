<?php
class Helpers {
    public static function displaySqueebTime($set_time) {
    	$mytime= strtotime($set_time);
		
		$timeposted = "@" . $mytime;
		
        if(date("Y")!=date('Y',$mytime))
		 return date('j M Y',$mytime);
		elseif((new DateTime("now"))->diff(new DateTime($timeposted))->d>=1)
		 return date('M j',$mytime);
	    elseif((new DateTime("now"))->diff(new DateTime($timeposted))->h>=1)
		 return (new DateTime("now"))->diff(new DateTime($timeposted))->h.'h';
	    elseif((new DateTime("now"))->diff(new DateTime($timeposted))->i>=1)
		 return (new DateTime("now"))->diff(new DateTime($timeposted))->i.'m';
	    else
		return (new DateTime("now"))->diff(new DateTime($timeposted))->s.'s';
    }
}
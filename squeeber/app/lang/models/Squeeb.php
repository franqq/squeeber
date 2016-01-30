<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Squeeb extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'squeebs';
	protected $fillable = array('model','views','shares','reports','branch_id','active');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	
	public function Notice()
	{
		return $this->hasOne('Notice','squeebs_id');
	}
	
	public function Eventsq()
	{
		return $this->hasOne('Eventsq','squeebs_id');
	}
	
	public function Job()
	{
		return $this->hasOne('Job','squeebs_id');
	}
	
	public function Offer()
	{
		return $this->hasOne('Offer','squeebs_id');
	}
	
	
	//relationships through squeeb main photos
	public function NoticePhoto()
    {
        return $this->hasManyThrough('NoticePhoto', 'Notice', 'squeebs_id', 'notices_id');
    }
	public function OfferPhoto()
    {
        return $this->hasManyThrough('OfferPhoto', 'Offer', 'squeebs_id', 'offers_id');
    }
	public function JobPhoto()
    {
        return $this->hasManyThrough('JobPhoto', 'Job', 'squeebs_id', 'jobs_id');
    }
	public function EventsqPhoto()
    {
        return $this->hasManyThrough('EventsqPhoto', 'Eventsq', 'squeebs_id', 'eventsqs_id');
    }
	
	
	//relations throuth squeeb poster details
	
}

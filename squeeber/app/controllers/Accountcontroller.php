<?php

class AccountController extends BaseController {

	
	public function getSignUpPage()
	{
		return View::make('guest.signup');
	}
	
	//method to redirect to the new users page
	public function getCompleteActivation($code)
	{
		//activate the account where code is code and redirect to login page with success message
		$user = User::where('code', '=', $code)->where('active', '=', FALSE);
		if($user->count())
		{
			$user = $user->first();
			
			$user->active = TRUE;
			$user->code = NULL;
			if($user->save()){
				
			return Redirect::route('login-get')->with('global','Congratulations!! Your Account has been activated.');
			}
			else if($user->code == NULL || $user->active == TRUE){
				return Redirect::route('login-get')->with('global','Your account is active. Please enter your login details to proceed.');
			}
		}
		return Redirect::route('signup-get')->with('global','Some unknown error occured. Please try again. Create a Squeeber Account');
	}
	
	public function postSignUp()
	{
		//verify the user input and create account
		$validator = Validator::make(Input::all(),array(
				'First_Name'				=>'required|max:50',
				'Last_Name'					=>'required|max:50',
				'Email'						=>'required|max:50|email',
				'Confirm_Email'				=>'required|same:Email',
				'Password'					=>'required',
				'Gender'					=>'required'
		));
		
		if($validator->fails())
		{
			return Redirect::route('signup-get')
			->withErrors($validator)
			->withInput();
		}
		else {
			$firstname = Input::get('First_Name');
			$lastname = Input::get('Last_Name');
			$email = Input::get('Email');
			$password = Input::get('Password');
			$gender = Input::get('Gender');
						
			 //generate the activation codes
			 $code					= str_random(60);
			 $m_code				= rand(10000, 99999);
			 
			 
			 //register the new user
			 $user		= User::create(array(
			 				'firstname'		=>$firstname,
			 				'lastname'		=>$lastname,
							'email'			=>$email,
							'password'		=>Hash::make($password),
							'gender'		=>$gender,
							'code'			=>$code,
							'm_code'		=>$m_code,
							'active'		=>0
			 ));
			 
			 if($user)
			 {
			 	Mail::send('emails.auth.activate',
					 array(
							'link' 		=>URL::route('account-activation-get',$code),
							'password'	=>$password
					 ),
					function($message) use ($user)
					{
							$message->to($user->email)->subject('Activate Your Account');
					}
				);
				
				return Redirect::route('signup-get')->with('email_sent_success','Activation Successful')
				->with('global','Your Account Has Been Created Successfully.<br />Activation link has been sent your Email:'.
				$email.'. If it takes more than 5 minutes, please check the spam mailbox.');
				
			 }
			
		}
	}
	
	
	public function getLogInPage()
	{
		return View::make('guest.login');
	}


	public function postLogIn()
	{
		$validator = Validator::make(Input::all(),array(
				'Email'				=>'required|email',
				'Password'			=>'required'
		));
		
		if($validator->fails())
		{
			return Redirect::route('login-get')
			->withErrors($validator)
			->withInput();
		}
		else{
			$auth = Auth::attempt(array(
				'email' => Input::get('Email'),
				'password' => Input::get('Password'),
			));
			
			if($auth)
			{
				// select the account to load and redirect to the intended page
				return Redirect::intended();
				
			}
			else{
				return Redirect::route('login-get')
				->with('global','Email or Phone - Password Mismatch');
			}
		}
	}

	public function logOut()
	{
		Auth::logout();
		return Redirect::route('login-get');
	}

	//get the password recovery page
	public function getForgotPassword()
	{
		return View::make('guest.forgot_password');
	}

	//get information from the user and send them a recoverly link
	public function postForgotPassword()
	{
		$validator = Validator::make(Input::all(),array(
				'Email'				=>'required|email',
		));
		
		if($validator->fails())
		{
			return Redirect::route('forgotpassword-get')
			->withErrors($validator)
			->withInput();
		}
		else{
			//get the user with the email entered
			$email = Input::get('Email');
			
			$user = User::where('email','=',$email);
			
			//if user exists
			if ($user->count()) {
				$user = $user->first();
				//generate a new code and password
				$code = str_random(60);
				$password = str_random(10);
				
				$user->code = $code;
				$fullname = $user->firstname.' '.$user->lastname;

				
				//account recovery for a user whose registration was incomplete				
				if($user->save())
				{
					//Send email
					Mail::send('emails.auth.forgot',
						array(
								'passlink' 		=> URL::route('reset-get',$code),
								'fullname'		=>$fullname,
						),
						function($message) use ($user)
						{
							$message->to($user->email)->subject('Password Reset');
						}
						);
						
						
					return Redirect::route('forgotpassword-get')
							->with('global','We have Sent you an email');
				}
			}
			//if the email does not exist inform them
			else {
				return Redirect::route('forgotpassword-get')
							->with('global','This email does not exist. Please try again');
			}
			return Redirect::route('forgotpassword-get')
							->with('global','Some error occured. Please try again');
		}
	}
	
	//get the password reset page
	public function getResetPassword($code)
	{
		View::share('identity_token',$code);
		return View::make('guest.reset_password');
	}
	
	
	public function postResetPassword()
	{
		$code = Input::get('identity_token');
		
		$validator = Validator::make(Input::all(),array(
				'Password'				=>'required',
				'Confirm_Password'		=>'required|same:Password'
		));
		
		if($validator->fails())
		{
			return Redirect::route('forgotpassword-get',$code)
			->withErrors($validator)
			->withInput();
		}
		else {
			
			$user = User::where('code','=',$code);
			//if user exists
			if ($user->count()) {
				$user = $user->first();
				$user->password = Hash::make(Input::get('Password'));
				
				//success message			
				if($user->save())
				{
					return Redirect::route('login-get')
					->with('global','Success!! Your password has been reset');
				}
				
			}
			
		}
		return Redirect::route('forgotpassword-get')
							->with('global','Some error occured. Please try again');
	}
}

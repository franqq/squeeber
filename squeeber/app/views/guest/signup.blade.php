@extends('guest.layouts.other_header')
@section('content')
<div class="wrapper indent">
			<!--Squeeber left side content to display the college details-->
			<aside class="col-6-1">
							<div class="collegeinside">
								
							</div>
			</aside>
		
<!-- content -->
			<section id="login_content" class="col-6-2">
				
				
				
						<div class="box maxheight">
							<div class="border-right maxheight">
								<div class="border-bot maxheight">
									<div class="border-left maxheight">
										<div class="left-top-corner maxheight">
											<div class="right-top-corner maxheight">
												
												<h2 style="text-transform:capitalize;"><span>Join Squeeber</span>	
												</h2>
												
												<div class="inner">
												
													
													@if(Session::has('global'))
														<p align="center" class="login_global"> {{Session::get('global')}} </p>
													@endif 
													
													<div class="login">
													<form id="loginf-form" method="post" action="{{URL::route('signup-post')}}">
														<div class="field">
															<label><strong>First Name*:</strong></label>
															<input type="text" required="required" autofocus="true" name="First_Name" 
															id="First_Name" e{{(Input::old('First_Name')) ? ' value = ' .Input::old('First_Name'). '' : ''}} />
															@if($errors->has('First_Name'))
								                        	<br />
															<p class="errors">{{$errors->first('First_Name')}}</p>
															@endif
														</div>
														
														<div class="field">
															<label><strong>Last Name*:</strong></label>
															<input type="text" required="required" name="Last_Name" 
															id="Last_Name" e{{(Input::old('Last_Name')) ? ' value = ' .Input::old('Last_Name'). '' : ''}} />
														</div>
														@if($errors->has('Last_Name'))
								                        	<br />
															<p class="errors" >{{$errors->first('Last_Name')}}</p>
														@endif
														
														<div class="field">
															<label><strong>Email*:</strong></label>
															<input type="text" required="required"	name="Email" id="Email"
															e{{(Input::old('Email')) ? ' value = ' .Input::old('Email'). '' : ''}} />
															@if($errors->has('Email'))
								                        	<br />
															<p class="errors" >{{$errors->first('Email')}}</p>
															@endif
														</div>
														
														<div class="field">
															<label><strong>Re-enter Email*:</strong></label>
															<input type="text" required="required" name="Confirm_Email" id="Confirm_Email"
															e{{(Input::old('Confirm_Email')) ? ' value = ' .Input::old('Confirm_Email'). '' : ''}} />
															@if($errors->has('Confirm_Email'))
								                        	<br />
															<p class="errors" >{{$errors->first('Confirm_Email')}}</p>
															@endif
														</div>
														
														<div class="field">
															<label><strong>Create Password*:</strong></label>
															<input type="password" required="required" 
															name="Password" id="Password" />
															@if($errors->has('Password'))
								                        	<br />
															<p class="errors" >{{$errors->first('Password')}}</p>
															@endif
														</div>
														
														<div class="field">
															<label><strong>Gender*:</strong></label><br /><br />
															<input type="radio"id="Gender" name="Gender" value="male" required="required" 
															@if(Input::old('Gender')=='male') checked="checked" @endif /> Male.
															<input type="radio" id="Gender" name="Gender" value="female" required="required"
															@if(Input::old('Gender')=='female') checked="checked"  @endif /> Female.
															<input type="radio" id="Gender" name="Gender" value="other" required="required"
															@if(Input::old('Other')=='other') checked="checked"  @endif /> Other.<br /><br />
															
															@if($errors->has('Gender'))
								                        	<br />
															<p class="errors" >{{$errors->first('Gender')}}</p>
															@endif
															<input type="submit" value="Sign Up"/>
															{{Form::token()}}
														</div>
														
														
														<div align="center" class="signup_link"> Have an account? <a href="{{URL::route('login-get')}}">Log In>></a> </div>
													</form>
													</div> 
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
			</section>
			
			
			
			
			
		</div>
		
@stop
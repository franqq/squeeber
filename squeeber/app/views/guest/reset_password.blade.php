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
												
												<h2 style="text-transform:capitalize;"><span>Reset Password</span>	
												</h2><br />
																								
												<div class="inner">
												
													
													@if(Session::has('global'))
														<p align="center" class="login_global"> {{Session::get('global')}} </p>
													@endif 
													
													<div class="login">
													<form id="loginf-form" method="post" action="{{URL::route('resetpassword-post')}}">												
														<div class="field">
															<label><strong>New Password*:</strong></label>
															<input type="password" required="required" 
															name="Password" id="Password" />
															@if($errors->has('Password'))
								                        	<br />
															<p class="errors" >{{$errors->first('Password')}}</p>
															@endif
														</div>
														
														<div class="field">
															<label><strong>Confirm Password*:</strong></label>
															<input type="password" required="required" 
															name="Confirm_Password" id="Confirm_Password" />
															@if($errors->has('Confirm_Password'))
								                        	<br />
															<p class="errors" >{{$errors->first('Confirm_Password')}}</p>
															@endif
														</div>
														
														<input type="hidden" name="identity_token" id="identity_token" value="{{$identity_token}}" />
														
														<div class="field">
															<input type="submit" value="Reset"/>
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
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
												
												<h2 style="text-transform:capitalize;"><span>Squeeber Login</span>	
												</h2>
												
												<div class="inner">
												
													
													<div class="login">
													<form id="loginf-form" method="post" action="{{URL::route('login-post')}}" >
														@if(Session::has('global'))
														<p class="login_global"> {{Session::get('global')}} </p>
														@endif
									
														<div class="field">
															<label><strong>Email*:</strong></label>
															<input type="text" required="required" autofocus="true" name="Email"
															 id="Email" e{{(Input::old('Email')) ? ' value = ' .Input::old('Email'). '' : ''}} />
															@if($errors->has('Email'))
								                        	<br />
															<p class="errors" >{{$errors->first('Email')}}</p>
															@endif
														</div>
														
														<div class="field">
															<label><strong>Password*:</strong></label>
															<input type="password" value="" required="required" 
															name="Password" id="Password" />
															@if($errors->has('Password'))
								                        	<br />
															<p class="errors" >{{$errors->first('Password')}}</p>
															@endif
														</div>
														
														<div class="field">
															<input checked="checked" type="checkbox" /> Keep me logged in.<br /><br />
															{{Form::token()}}
															<input type="submit" value="Log In"/>
														</div>
														
														<div class="field">
															<p>
															<a href="{{URL::route('forgotpassword-get')}}">Forgot Password?</a> </p>
														</div>
														<div align="center" class="signup_link"> New to Squeeber? <a href="{{URL::route('signup-get')}}" >Sign up now>></a> </div>
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
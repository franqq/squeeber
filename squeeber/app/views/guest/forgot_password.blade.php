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
												
												<h2 style="text-transform:capitalize;"><span>Password Recovery</span>	
												</h2>
												
												<div class="inner">
												
													
													@if(Session::has('global'))
														<p align="center" class="login_global"> {{Session::get('global')}} </p>
													@endif 
													
													<div class="login">
													<form id="loginf-form" method="post" action="{{URL::route('forgotpassword-post')}}">
														
														<div class="field">
															<label><strong>Enter Email*:</strong></label>
															<input type="text" required="required"	name="Email" id="Email"
															e{{(Input::old('Email')) ? ' value = ' .Input::old('Email'). '' : ''}} />
															@if($errors->has('Email'))
								                        	<br />
															<p class="errors" >{{$errors->first('Email')}}</p>
															@endif
														</div>
													
														<div class="field">
															<input type="submit" value="Recover"/>
															{{Form::token()}}
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
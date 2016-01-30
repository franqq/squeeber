@extends('guest.layouts.advanced_header')
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
												<div class="inner">
														<h2 style="text-transform:capitalize;"><span>College Squeeb Package</span>	
												</h2>
													
													<div class="post">
													<form name="post-form"  id="postf-form" method="post" action="{{URL::route('advancedselectcollege1-post')}}" >
														
														@if(Session::has('global'))
															<p align="center" class="post_global">{{Session::get('global')}} </p>
														@endif 
																												
														<div class="field">
														<label2><strong>Country<required>*<required></strong></label2>
																<select required="required" name="Country" onchange="this.form.submit()" >
																	  <option value="">Select Country</option>
																	 
																	  @foreach($countries as $country)
																	  <option @if($countryid == $country->id)selected@endif value="{{$country->id}}">{{$country->name}}</option>
																	  @endforeach
																	  
																</select>
																@if($errors->has('Country'))
																<p class="post_errors">* {{$errors->first('Country')}}</p>
																@endif	
																{{Form::token()}}							
																
														</div>
														</form>
														
														
														<form name="post-form"  id="postf-form" method="post" action="{{URL::route('advanced_squeeb-post-data-college-1')}}" >
														<div class="field">
														<label2><strong>College<required>*<required></strong></label2>
																<select required="required" name="College">
																	  <option value="">Select College</option>
																	  @if(isset($colleges))
																	      @foreach($colleges as $college)
																		 	 <option value="{{$college->id}}">{{$college->name}}</option>
																		  @endforeach
																	  @endif
																</select>
																@if($errors->has('College'))
																<p class="post_errors">* {{$errors->first('College')}}</p>
																@endif								
																
														</div>
														<div class="field">
															{{Form::token()}}
															<label2><strong>&nbsp;</strong></label2><input  type="submit" value="Continue"/>
														</div>
														</form>
														
														
														
														<div align="center" class="signup_link"><a href="{{URL::route('newcollege-get')}}">College name not Listed? Click to Add>></a> </div>
													
													
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
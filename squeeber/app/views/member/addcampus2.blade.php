@extends('member.layouts.other_header')
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
												
												<h2 style="text-transform:capitalize;"><span>New Campus</span>	
												</h2>
												
												<div class="inner">
														
													
													<div class="post">
													<form name="post-form"  id="postf-form" method="post" action="{{URL::route('newcampus-post')}}" >
														
														@if(Session::has('global'))
														<div class="field">
															<p align="center" class="post_global">{{Session::get('global')}} </p>
														</div>
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
														
														<form name="post-form"  id="postf-form" method="post" action="{{URL::route('newcampus-post2')}}" >
														
														<div class="field">
														<label2><strong>College<required>*<required></strong></label2>
																<select required="required" name="College">
																	  <option value="">Select College</option>
																	 
																	  @foreach($colleges as $college)
																	  	<option value="{{$college->id}}">{{$college->name}}</option>
																	  @endforeach
																	  
																</select>
																@if($errors->has('College'))
																<p class="post_errors">* {{$errors->first('College')}}</p>
																@endif								
																
														</div>
														
														<div class="field">
																<label2><strong>Campus Name<required>*<required></strong></label2>
																<input required="required" e{{(Input::old('Campus')) ? ' value = ' .Input::old('Campus'). '' : ''}} placeholder="eg Main" name="Campus" type="text">
																@if($errors->has('Campus'))
																	<p class="post_errors">* {{$errors->first('Campus')}}</p>
																@endif	
														</div>
														
														
														<div class="field">
															{{Form::token()}}
															<label2><strong>&nbsp;</strong></label2><input  type="submit" value="Add Campus"/>
														</div>
													
														<div align="center" class="signup_link"><a href="{{URL::route('newcollege-get')}}">College name not Listed? Click to Add>></a> </div>
													</form>
													
													
													
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
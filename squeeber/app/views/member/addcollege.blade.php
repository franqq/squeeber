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
												
												<h2 style="text-transform:capitalize;"><span>New College Details</span>	
												</h2>
												
												<div class="inner">
														
													
													<div class="post">
													<form name="post-form"  id="postf-form" enctype="multipart/form-data"  method="post" action="{{URL::route('newcollege-post')}}" >
														
														@if(Session::has('global'))
														<div class="field">
															<p align="center" class="post_global">{{Session::get('global')}} </p>
														</div>
														@endif 
														
														<div class="field">
															<label><strong>College Details:</strong></label>
														</div>
														
														<div class="field">
														<label2><strong>Country<required>*<required></strong></label2>
																<select required="required" name="Country">
																	  <option value="">Select Country</option>
																	 
																	  @foreach($countries as $country)
																	  <option value="{{$country->id}}">{{$country->name}}</option>
																	  @endforeach
																	  
																</select>
																@if($errors->has('Country'))
																<p class="post_errors">* {{$errors->first('Country')}}</p>
																@endif								
																
														</div>
														
														
														
														<div class="field">
																<label2><strong>College Name <required>*<required></strong></label2>
																<input required="required" name="College_Name" type="text" e{{(Input::old('College_Name')) ? ' value = ' .Input::old('College_Name'). '' : ''}} placeholder="eg. Jomo Kenyatta University of Agriculture and Technology" >
																@if($errors->has('College_Name'))
																	<p class="post_errors">* {{$errors->first('College_Name')}}</p>
																@endif	
														</div>
														
														<div class="field">
																<label2><strong>Alias <required>*<required></strong></label2>
																<input required="required" e{{(Input::old('Alias')) ? ' value = ' .Input::old('Alias'). '' : ''}} name="Alias" 
																type="text" placeholder="eg. JKUAT" >
																@if($errors->has('Alias'))
																	<p class="post_errors">* {{$errors->first('Alias')}}</p>
																@endif	
														</div>
														
														<div class="field">
															<label2><strong>Squeeb Pic </strong></label2>
															<input type="file" e{{(Input::old('Pic')) ? ' value = ' .Input::old('Pic'). '' : ''}} name="Pic" />
															@if($errors->has('Pic'))
																<p class="post_errors">* {{$errors->first('Pic')}}</p>
															@endif	
														</div>
														
														<div class="field">
															{{Form::token()}}
															<label2><strong>&nbsp;</strong></label2><input  type="submit" value="Save College"/>
														</div>
													
														<div align="center" class="signup_link"><a href="{{URL::route('newcampus-get')}}">College Exists? Click to add Campus>></a> </div>
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
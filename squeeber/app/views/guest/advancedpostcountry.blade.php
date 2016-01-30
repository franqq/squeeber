@extends('guest.layouts.advanced_header')
@section('content')

<div style="margin:0;">
<p class="change-college">
		<a><strong>{{$msg}}</strong></a>
</p>
</div>

<div class="wrapper indent">
			<!--Squeeber left side content to display the college details-->
			<aside class="col-6-1">
				<div class="collegeinside">
				</div>			
			</aside>
		
<!-- content -->
			<section id="login_content" class="col-6-2">
				
				
				<div class="wrapper">
						<div class="wrap-col">
						<div class="box maxheight">
							<div class="border-right maxheight">
								<div class="border-bot maxheight">
									<div class="border-left maxheight">
										<div class="left-top-corner maxheight">
											<div class="right-top-corner maxheight">
												
												<h2 style="text-transform:capitalize;"><span>Post Squeeb</span>	
												</h2>
												
												<div class="inner">
												
													<div class="post">
													<form name="post-form"  id="postf-form" enctype="multipart/form-data" method="post" action="{{URL::route('advanced_squeeb-post-data-country')}}" >
														
														@if(Session::has('global'))
														
															<p align="center" class="post_global">{{Session::get('global')}} </p>
							
														@endif 
														
														<div class="field">
															<label><strong>Squeeb Details:</strong></label>
														</div>
														
														<div class="field">
														<label2><strong>Country<required>*<required></strong></label2>
																<select required="required" name="Country">
																	  <option value="">Select Country/option>
																	  @foreach($countries as $country)
																	  <option @if($countryid == $country->id)selected@endif value="{{$country->id}}" >{{$country->name}}</option>
																	  @endforeach
																</select>
																@if($errors->has('Country'))
																<p class="post_errors">* {{$errors->first('Country')}}</p>
																@endif	
										
														</div>
														
														<div class="field">
														<label2><strong>Type <required>*<required></strong></label2>
																<select required="required" name="Type">
																  <option value="">Select squeeb type</option>
																  <option @if(Input::old('Type')=='Notice') selected="selected" @endif value="Notice">College News/Stories</option>
																  <option @if(Input::old('Type')=='Eventsq') selected="selected" @endif  value="Eventsq">College Events</option>
																  <option @if(Input::old('Type')=='Job') selected="selected" @endif value="Job">College Jobs/Internships</option>
																  <option @if(Input::old('Type')=='Offer') selected="selected" @endif value="Offer">College Classifieds</option>
																</select>
															@if($errors->has('Type'))
															<p class="post_errors">* {{$errors->first('Type')}}</p>
															@endif								
																
														</div>
														
														
																		
														<div class="field">
																<label2><strong>Title <required>*<required></strong></label2>
																<input required="required" placeholder="Enter Short Title" maxlength="40" e{{(Input::old('Title')) ? ' value = ' .Input::old('Title'). '' : ''}} name="Title" type="text">
																@if($errors->has('Title'))
																	<p class="post_errors">* {{$errors->first('Title')}}</p>
																@endif	
														</div>
														
														<div class="field">
															<label2><strong>Squeeb Photo </strong></label2>
															<input type="file" e{{(Input::old('Pic')) ? ' value = ' .Input::old('Pic'). '' : ''}} name="Pic" />
															@if($errors->has('Pic'))
																<p class="post_errors">* {{$errors->first('Pic')}}</p>
															@endif	
														</div>
														
														<div class="field">
																<label3><strong>Describe your Squeeb <required>*<required></strong></label3>
																<textarea rows="2" name="Description" placeholder="Enter a detailed description. Include contact information and price.. " required="required" cols="20" style="" >@if(Input::old('Description')){{Input::old('Description')}}@endif</textarea>
    
																@if($errors->has('Description'))
																	<p class="errors">* {{$errors->first('Description')}}</p>
																@endif																	
														</div>	
													
														
														<div class="field">
															<label><strong>User Details:</strong></label>
														</div>
														
														<div class="field">
																<label2><strong>Name <required>*<required></strong></label2>
																<input required="required" e{{(Input::old('Name')) ? ' value = ' .Input::old('Name'). '' : ''}} name="Name" type="text">
																@if($errors->has('Name'))
																	<p class="post_errors">* {{$errors->first('Name')}}</p>
																@endif	
														</div>
														
														<div class="field">
																<label2><strong>Email <required>*<required></strong></label2>
																<input required="required" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" e{{(Input::old('Email')) ? ' value = ' .Input::old('Email'). '' : ''}} name="Email" type="text">
																@if($errors->has('Email'))
																	<p class="post_errors">* {{$errors->first('Email')}}</p>
																@endif
														</div>
														
											
														
														<div class="field">
															{{Form::token()}}
															<label2><strong>&nbsp;</strong></label2><input  type="submit" value="Save Squeeb"/>
														</div>
														
														
													
														
														<div align="center" class="signup_link">
														</div>
													</form>
													
													
													
												</div> 
												
												</div>
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
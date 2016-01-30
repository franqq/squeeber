@extends('guest.layouts.selects_header')
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
												<h2 style="text-transform:capitalize;"><span>Select Campus</span>	
												</h2>
												
												<div class="inner">
														
													
													<div class="post">
													
														
														<form name="post-form"  id="postf-form" method="post" action="{{URL::route('selectcampus2-post')}}" >
														<div class="field">
														<label2><strong>College<required>*<required></strong></label2>
																<select required="required" name="College">
																	  <option value="">Select College</option>
																	  @foreach($colleges as $college)
																	  <option @if($collegeid == $college->id)selected@endif value="{{$college->id}}" >{{$college->name}}</option>
																	  @endforeach
																</select>
																@if($errors->has('College'))
																<p class="post_errors">* {{$errors->first('College')}}</p>
																@endif	
																<input type="hidden" name="CountryID value="{{$countryid}}" />							
																{{Form::token()}}		
														</div>
														</form>
														
														
														<form name="post-form"  id="postf-form" method="post" action="{{URL::route('selectcampus3-post')}}" >
														<div class="field">
														<label2><strong>Campus<required>*<required></strong></label2>
																<select required="required" name="Campus">
																	  <option value="">Select Campus</option>
																	   @foreach($campuses as $campus)
																	  <option  value="{{$campus->id}}" >{{$campus->name}}</option>
																	  @endforeach
																</select>	
																@if($errors->has('Campus'))
																<p class="post_errors">* {{$errors->first('Campus')}}</p>
																@endif																
														</div>																																			
														
														<div class="field">
															{{Form::token()}}
															<label2><strong>&nbsp;</strong></label2><input  type="submit" value="Submit"/>
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
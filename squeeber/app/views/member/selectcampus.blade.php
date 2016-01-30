@extends('guest.layouts.post_header')
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
												
												<h2 style="text-transform:capitalize;"><span>College Details: </span>	
												</h2>
												
												<div class="inner">
												
													
													<div class="post">
													<form name="post-form"  id="postf-form" method="post"  action="{{URL::route('loadcolleges-post')}}" >
														
														@if(Session::has('global'))
														<div class="field">
															<p align="center" class="post_global">{{Session::get('global')}} </p>
														</div>
														@endif 
														
														
														<div class="field">
														<label2><strong>Country<required>*<required></strong></label2>
																<select required="required" name="Country" id="Country" >
																	  <option value="">Select Country</option>
																	 
																	  @foreach($countries as $country)
																	  <option value="{{$country->id}}">{{$country->name}}</option>
																	  @endforeach
																	  
																</select>
																@if($errors->has('Country'))
																<p class="post_errors">* {{$errors->first('Country')}}</p>
																@endif								
																
														</div>
														
														<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
														
														<script>
															
															
															jquery(document).ready(function($){
																$('#postf-form').on('submit',function(){
																
																	$.post(
																		$(this).prop('action'),
																		{
																			"_token":$(this).find('input[name=_token]').val(),
																			"countryid":$(this).find('input[name=Country]').val()
																		},
																		function(data){
																			
																		},'json'
																	);
																	return false
																	
																	});
																});
														</script>
														
														<div id="ajaxrequest" ></div>
														
														<div class="field">
														<label2><strong>College<required>*<required></strong></label2>
																<select  name="College"  onchange="this.form.submit()" >
																	  <option value="">Select College</option>
																	 
																	  
																	  
																</select>
																@if($errors->has('College'))
																<p class="post_errors">* {{$errors->first('College')}}</p>
																@endif								
																
														</div>
														
														<div class="field">
														<label2><strong>Campus<required>*<required></strong></label2>
																<select  name="Campus">
																	  <option value="">Select Campus</option>
																	 
																	  
																	  
																</select>
																@if($errors->has('Campus'))
																<p class="post_errors">* {{$errors->first('Campus')}}</p>
																@endif								
																
														</div>
																												
														
														
														
														
														
														
														<div class="field">
															{{Form::token()}}
															<label2><strong>&nbsp;</strong></label2><input id="Submit"  type="submit" value="Load Squeeb"/>
														</div>
													
													<div align="center" class="signup_link"><a href="{{URL::route('newcampus-get')}}">Campus name not Listed? Click to Add>></a> </div>
														
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
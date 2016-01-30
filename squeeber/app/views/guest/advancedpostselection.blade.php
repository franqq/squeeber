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
				
				
				<div class="wrapper">
						<div class="wrap-col">
						<div class="box maxheight">
							<div class="border-right maxheight">
								<div class="border-bot maxheight">
									<div class="border-left maxheight">
										<div class="left-top-corner maxheight">
											<div class="right-top-corner maxheight">
												
												<h2 style="text-transform:capitalize;"><span>Advanced Squeeb</span>	
												</h2>
												
												<div class="inner">
												
													<div class="post">
													<form name="post-form"  id="postf-form" enctype="multipart/form-data" method="post" action="{{URL::route('advanced_squeeb-post')}}" >
														
														@if(Session::has('global'))
														
															<p align="center" class="post_global">{{Session::get('global')}} </p>
							
														@endif 
														
														<div class="field">
															<label><strong>Select Package:</strong></label>
														</div>
														
														
																		
														<div class="field">
																<input style="float:left;" required="required" value="pkg1" name="Package" type="radio" >
																<div style="float:left;margin-left:10px;">
																<strong> College Squeeb Package ($0.00 USD)</strong><br />
																(The post will appear in all the campuses of a particular college)
																</div>
														</div>
														
														<div class="field">
																<input style="float:left;" required="required" value="pkg2" name="Package" type="radio" >
																<div style="float:left;margin-left:10px;">
																<strong> Country Squeeb Package ($0.00 USD)</strong><br />
																(The post will appear in all the campuses of all colleges in a particular country)
																</div>
														</div>
														
														<div class="field">
																<input style="float:left;" required="required" value="pkg3" name="Package" type="radio" >
																<div style="float:left;margin-left:10px;">
																<strong> World Squeeb Package ($0.00 USD)</strong><br />
																(The post will appear in all the campuses of all colleges in all countries listed)
																</div>
														</div>							
													
														<div class="field">
															{{Form::token()}}
															<input  type="submit" value="Submit"/>
														</div>
													
														
														<div align="center" class="signup_link">
															<a href="{{URL::route('login-get')}}">Free Posting>></a> 
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
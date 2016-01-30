@extends('guest.layouts.selects_header')
@section('content')
<div class="wrapper indent">
			
		
<!-- content -->
			<section id="login_content" style="width:96%;margin-left:2%;" >
				
				
				
						<div class="box maxheight">
							<div class="border-right maxheight">
								<div class="border-bot maxheight">
									<div class="border-left maxheight">
										<div class="left-top-corner maxheight">
											<div class="right-top-corner maxheight">
												
												<h2 style="text-transform:capitalize;"><span>Welcome to Squeeber</span>	
												</h2>
												
												<div class="inner">
														
													
													<div class="post">
													
														
														@if(Session::has('global'))
															<p align="center" class="post_global">{{Session::get('global')}} </p>
														@endif 
																												
														
													<div class="countriesdesktopdisplay">															
													@include('guest.layouts.countries_main')
													</div>
													<div class="countriestabdisplay">															
													@include('guest.layouts.countries_tab')
													</div>	
													<div class="countriesphonedisplay">															
													@include('guest.layouts.countries_phone')
													</div>
													<div class="countriesfeaturephonedisplay">															
													@include('guest.layouts.countries_feature_phone')
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
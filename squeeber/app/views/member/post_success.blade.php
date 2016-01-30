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
												
												<h2 style="text-transform:capitalize;"><span>
													Success
													</span></h2>
													
												<div class="inner">
												
												<div class="fullsqueeb">
												
												<squeebdesc>
													Congratulations!! Your Squeeb has been posted successfully.													
												</squeebdesc>
												
												<div class="activatesqueeb">
													<form id="activatesqueeb-form" method="post" action="{{URL::route('member-home-post')}}" >
													
														<div class="field">
															{{Form::token()}}
															<input type="submit" value="Continue"/>
														</div>
													</form>													
												</div>
												
												</squeebshare>
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
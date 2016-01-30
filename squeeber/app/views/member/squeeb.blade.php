@extends('guest.layouts.squeeb_header')
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
														{{$squeeb->title}}
													</span></h2>
													
												<div class="inner">
												
												<div class="fullsqueeb">
												<squeebimg>
														@if($model == 'Notice')
															{{HTML::image(isset($squeeb->NoticePhoto()->first()->name) ? 'squeeb_photos/'.$squeeb->NoticePhoto()->first()->name : 'squeeb_photos/default.png','$squeeb->title')}}
														@elseif($model == 'Offer')
															{{HTML::image(isset($squeeb->OfferPhoto()->first()->name) ? 'squeeb_photos/'.$squeeb->OfferPhoto()->first()->name : 'squeeb_photos/default.png','$squeeb->title')}}
														@elseif($model == 'Job')
															{{HTML::image(isset($squeeb->JobPhoto()->first()->name) ? 'squeeb_photos/'.$squeeb->JobPhoto()->first()->name : 'squeeb_photos/default.png','$squeeb->title')}}
														@else
															{{HTML::image(isset($squeeb->EventsqPhoto()->first()->name) ? 'squeeb_photos/'.$squeeb->EventsqPhoto()->first()->name : 'squeeb_photos/default.png','$squeeb->title')}}
														@endif
												</squeebimg>
												
												<squeebdesc>
														{{nl2br($squeeb->description)}}
												</squeebdesc>
												
												@if(Session::has('global'))
														<br /><br />
														<div class="field">
															<p align="center" class="post_global">{{Session::get('global')}} </p>
														</div>
												@else
														@include('member.layouts.other_share_report')
												@endif
												
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
@extends('guest.layouts.squeeb_home_header')
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
													@if($model == 'Notice')
														{{$squeeb->Notice()->first()->title}}
													@elseif($model == 'Offer')
														{{$squeeb->Offer()->first()->title}}
													@elseif($model == 'Job')
														{{$squeeb->Job()->first()->title}}
													@else
														{{$squeeb->Eventsq()->first()->title}}
													@endif
													</span></h2>
													
												<div class="inner">
												
												<div class="fullsqueeb">
												<squeebimg>
														@if($model == 'Notice')
															{{HTML::image(isset($squeeb->Notice()->first()->NoticePhoto()->first()->name) ? 'squeeb_photos/'.$squeeb->Notice()->first()->NoticePhoto()->first()->name : 'squeeb_photos/default.png' , 'pic')}}
														@elseif($model == 'Offer')
															{{HTML::image(isset($squeeb->Offer()->first()->OfferPhoto()->first()->name) ? 'squeeb_photos/'.$squeeb->Offer()->first()->OfferPhoto()->first()->name : 'squeeb_photos/default.png' , 'pic')}}
														@elseif($model == 'Job')
															{{HTML::image(isset($squeeb->Job()->first()->JobPhoto()->first()->name) ? 'squeeb_photos/'.$squeeb->Job()->first()->JobPhoto()->first()->name : 'squeeb_photos/default.png' , 'pic')}}
														@else
															{{HTML::image(isset($squeeb->Eventsq()->first()->EventsqPhoto()->first()->name) ? 'squeeb_photos/'.$squeeb->Eventsq()->first()->EventsqPhoto()->first()->name : 'squeeb_photos/default.png' , 'pic')}}
														@endif
												</squeebimg>
												<squeebdesc>
													@if($model == 'Notice')
														{{nl2br($squeeb->Notice()->first()->description)}}
													@elseif($model == 'Offer')
														{{nl2br($squeeb->Offer()->first()->description)}}
													@elseif($model == 'Job')
														{{nl2br($squeeb->Job()->first()->description)}}
													@else
														{{nl2br($squeeb->Eventsq()->first()->description)}}
													@endif
												</squeebdesc>
												
												@if(Session::has('global'))
														<br /><br />
														<div class="field">
															<p align="center" class="post_global">{{Session::get('global')}} </p>
														</div>
												@else
														@include('member.layouts.share_report')
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
@extends('guest.layouts.squeeb_home_header')

@section('content')
<div class="wrapper indent">

			<!--Squeeber left side content to display the college details-->
			<aside class="col-6-1">
							<div class="collegeinside">
								@if($deviceType=='computer')
								<a href="http://marketing.net.jumia.co.ke/ts/i3176314/tsc?amc=aff.jumia.26680.31133.16885&tst=!!TIMESTAMP!!" target="_blank" rel="nofollow">
								<img src="http://marketing.net.jumia.co.ke/ts/i3176314/tsv?amc=aff.jumia.26680.31133.16885&tst=!!TIMESTAMP!!" border=0 width="300" height="600" alt="Infinix 507 (300 x 600)" />
								</a>
								@endif
							</div>
			</aside>
			
			@if($deviceType!='computer')
			<a  href="http://marketing.net.jumia.co.ke/ts/i3176314/tsc?amc=aff.jumia.26680.31133.16886&tst=!!TIMESTAMP!!" target="_blank" rel="nofollow">
			<img align="center" src="http://marketing.net.jumia.co.ke/ts/i3176314/tsv?amc=aff.jumia.26680.31133.16886&tst=!!TIMESTAMP!!" border=0 width="100%" height="100" alt="Infinix507 (320 x 100)" />
			</a>	
			@endif
			
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
															{{HTML::image(isset($squeeb->Notice()->first()->NoticePhoto()->first()->name) ? 'squeeb_photos/'.$squeeb->Notice()->first()->NoticePhoto()->first()->name : 'squeeb_photos/default.png' , '$squeeb->Notice()->first()->title')}}
														@elseif($model == 'Offer')
															{{HTML::image(isset($squeeb->Offer()->first()->OfferPhoto()->first()->name) ? 'squeeb_photos/'.$squeeb->Offer()->first()->OfferPhoto()->first()->name : 'squeeb_photos/default.png' , '$squeeb->Offer()->first()->title')}}
														@elseif($model == 'Job')
															{{HTML::image(isset($squeeb->Job()->first()->JobPhoto()->first()->name) ? 'squeeb_photos/'.$squeeb->Job()->first()->JobPhoto()->first()->name : 'squeeb_photos/default.png' , '$squeeb->Job()->first()->title')}}
														@else
															{{HTML::image(isset($squeeb->Eventsq()->first()->EventsqPhoto()->first()->name) ? 'squeeb_photos/'.$squeeb->Eventsq()->first()->EventsqPhoto()->first()->name : 'squeeb_photos/default.png' , '$squeeb->Eventsq()->first()->title')}}
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
														@include('guest.layouts.share_report')
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
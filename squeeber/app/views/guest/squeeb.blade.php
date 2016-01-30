@extends('guest.layouts.squeeb_header')
@if($deviceType!='computer')
@else
@endif
@section('content')
<div class="wrapper indent">
			<!--Squeeber left side content to display the college details-->
			<aside class="col-6-1">
							<div class="collegeinside">
								
								@if($deviceType=='computer')
								<script type="text/javascript">
									<!--
									var _adynamo_client = "7FE56DE7-9504-46BB-9CE1-6F2C1548B38D";
									var _adynamo_width = 160;
									var _adynamo_height = 600;
									//-->
								</script>
								<script type="text/javascript" src="http://static.addynamo.net/ad/js/deliverAds.js"></script>
								@endif
							
							</div>
			</aside>
			
			@if($deviceType!='computer')		
			<script type="text/javascript">
				<!--
				try{
					var _adynamo_client = "97F4F52A-982B-43C6-B88F-CC17D7E18D34";
					var _adynamo_width = 300;
					var _adynamo_height = 50;
					var _adynamo_v = 1;
				} catch (e){
				}
				//-->
			</script>
			<script type="text/javascript" src="http://static.addynamo.net/ad/js/deliverMobileAds.js"></script>
			<noscript>
				<a href="http://s01-delivery.addynamo.net/ad.cfm?uidChanel=97F4F52A-982B-43C6-B88F-CC17D7E18D34">
					<img src="http://s01-delivery.addynamo.net/AdDelivery/AdDelivery_Mobile.cfm?uidChanel=97F4F52A-982B-43C6-B88F-CC17D7E18D34" width="300" height="50" border="0" />
				</a>
			</noscript>
			
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
														@include('guest.layouts.other_share_report')
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
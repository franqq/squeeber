@extends('member.layouts.offer_header')
@section('content')
<div class="wrapper indent">
			<!--Squeeber left side content to display the college details-->
			<aside class="col-4-4">
							<div class="collegeinside">
								@include('member.layouts.college_details')
								
								<ul class="services">
									@foreach($topsqueebs as $topsqueeb)
										<li><a href="{{URL::route('offer-get',$topsqueeb->Offer()->first()->id)}}">{{$topsqueeb->Offer()->first()->title}}</a></li>
									@endforeach
								</ul>
								</div>
								
							</div>
			</aside>
		
<!-- content -->
			<section id="content" class="col-3-4">
				
				
				<div class="wrapper">
						<div class="wrap-col">
						<div class="box maxheight">
							
										<div class="left-top-corner maxheight">
											<div class="right-top-corner maxheight">
												
												<h2 style="text-transform:capitalize;"><span>{{$college->alias}} Offers</span>	
												</h2>
												
												<div class="inner">
												
												  
												  <ul class="mysqueeb">
														
														@foreach($squeebs as $squeeb)
														<div class="news-feed">
															<li>
																<a href="{{URL::route('offer-get',$squeeb->id)}}">
																	<div id="mainimg" style="background-image:url({{isset($squeeb->OfferPhoto()->first()->name) ? 'http://www.squeeber.com/squeeb_photos/'.$squeeb->OfferPhoto()->first()->name : 'http://www.squeeber.com/squeeb_photos/default.png'}});" >
																			</div>
																</a>
																
													
																
																<stime>
																	{{HTML::image('images/offer.png')}} {{Helpers::displaySqueebTime($squeeb->created_at).' '}} - <b>{{' @'.$squeeb->User()->first()->firstname}}:</b> 
																</stime>
																
																<strong> <a href="{{URL::route('offer-get',$squeeb->id)}}">{{$squeeb->title}}
																</a>
																</strong>
																
																<psquib>
																{{substr(ucfirst($squeeb->squeeb), 0, 40) }}<a href="{{URL::route('offer-get',$squeeb->id)}}">...see more</a>
																</psquib>
																
																@include('member.layouts.other_share')
															</li>
														</div>
													@endforeach
														
												  </ul>
												  
												 
												</div>
											
								</div>
							</div>
						</div>
						</div>
				</div>
			</section>
			<!-- aside -->
			<aside class="col-1-4">
				<div class="inside">
								
				</div>
			</aside>
			
			
			
			
		</div>
		
		<div align="center" class="see-more">
			  @if(!isset($squeeb)) No Offers have been posted. @elseif(!$more) No more Offers.   @else <a href="{{URL::route('more-offers-get',$last_id)}}" > See More </a>@endif
			</div>
@stop
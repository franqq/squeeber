@extends('member.layouts.main_header')
@section('content')


	@if(Session::has('global'))
	<div class="change-college">
		<p align="center" class="post_global">{{Session::get('global')}} </p>
	</div>
	@endif 													


<div class="wrapper indent">
			<!--Squeeber left side content to display the college details-->
			<aside class="col-4-4">
							<div class="collegeinside">
								
								@include('member.layouts.college_details')
								<ul class="services">
								@foreach($newsqueebs as $newsqueeb)
									@if($newsqueeb->model == 'Notice')
										<li><a href="{{URL::route('notice-get',$newsqueeb->Notice()->first()->id)}}">{{$newsqueeb->Notice()->first()->title}}</a></li>
									@elseif($newsqueeb->model == 'Offer')
										<li><a href="{{URL::route('offer-get',$newsqueeb->Offer()->first()->id)}}">{{$newsqueeb->Offer()->first()->title}}</a></li>
									@elseif($newsqueeb->model == 'Job')
										<li><a href="{{URL::route('job-get',$newsqueeb->Job()->first()->id)}}">{{$newsqueeb->Job()->first()->title}}</a></li>
									@else
										<li><a href="{{URL::route('event-get',$newsqueeb->Eventsq()->first()->id)}}">{{$newsqueeb->Eventsq()->first()->title}}</a></li>
									@endif
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
												
												<h2 style="text-transform:capitalize;"><span>Squeeb Board</span>	
												</h2>
												
												<div class="inner">
												
													 
												<ul class="mysqueeb">
													
													
														@foreach($squeebs as $squeeb)
															<div class="news-feed">
																<li>
																	
																	
																	@if($squeeb->model == 'Notice')
																		
																		<a href="{{URL::route('squeeb-get',$squeeb->model.'/'.$squeeb->id)}}">
															
																			<div id="mainimg" style="background-image:url({{isset($squeeb->NoticePhoto()->first()->name) ? 'http://www.squeeber.com/squeeb_photos/'.$squeeb->NoticePhoto()->first()->name : 'http://www.squeeber.com/squeeb_photos/default.png'}});" >
																			</div>
																		</a>
																		
															
																		
																		<stime>
																			{{HTML::image('images/notice.png')}} {{Helpers::displaySqueebTime($squeeb->Notice()->first()->created_at)}} - <b>{{' @'.$squeeb->Notice()->first()->User()->first()->firstname}}:</b> 
																		</stime>
																		
																		<strong> <a href="{{URL::route('squeeb-get',$squeeb->model.'/'.$squeeb->id)}}">{{$squeeb->Notice()->first()->title}}
																		</a>
																		</strong>
																		
																		<psquib>
																		{{substr(ucfirst($squeeb->Notice()->first()->squeeb), 0, 40) }}<a href="{{URL::route('squeeb-get',$squeeb->model.'/'.$squeeb->id)}}" >...see more</a>
																		</psquib>
																		
																		@include('member.layouts.share')
																
																
																	@elseif($squeeb->model == 'Offer')
																		<a href="{{URL::route('squeeb-get',$squeeb->model.'/'.$squeeb->id)}}">
																			<div id="mainimg" style="background-image:url({{isset($squeeb->OfferPhoto()->first()->name) ? 'http://www.squeeber.com/squeeb_photos/'.$squeeb->OfferPhoto()->first()->name : 'http://www.squeeber.com/squeeb_photos/default.png'}});" >
																			</div>
																		</a>
																		
															
																		
																		<stime>
																			{{HTML::image('images/offer.png')}} {{Helpers::displaySqueebTime($squeeb->Offer()->first()->created_at)}} - <b>{{' @'.$squeeb->Offer()->first()->User()->first()->firstname}}:</b> 
																		</stime>
																		
																		<strong> <a href="{{URL::route('squeeb-get',$squeeb->model.'/'.$squeeb->id)}}">{{$squeeb->Offer()->first()->title}}
																		</a>
																		</strong>
																		
																		<psquib>
																		{{substr(ucfirst($squeeb->Offer()->first()->squeeb), 0, 40) }}<a href="{{URL::route('squeeb-get',$squeeb->model.'/'.$squeeb->id)}}" >...see more</a>
																		</psquib>
																		
																		@include('member.layouts.share')
																		
																		
																	@elseif($squeeb->model == 'Job')
														
																		<a href="{{URL::route('squeeb-get',$squeeb->model.'/'.$squeeb->id)}}">
																			<div id="mainimg" style="background-image:url({{isset($squeeb->JobPhoto()->first()->name) ? 'http://www.squeeber.com/squeeb_photos/'.$squeeb->JobPhoto()->first()->name : 'http://www.squeeber.com/squeeb_photos/default.png'}});" >
																			</div>
																		</a>
																		
															
																		
																		<stime>
																			{{HTML::image('images/career.png')}} {{Helpers::displaySqueebTime($squeeb->Job()->first()->created_at)}} - <b>{{' @'.$squeeb->Job()->first()->User()->first()->firstname}}:</b> 
																		</stime>
																		
																		<strong> <a href="{{URL::route('squeeb-get',$squeeb->model.'/'.$squeeb->id)}}">{{$squeeb->Job()->first()->title}}
																		</a>
																		</strong>
																		
																		<psquib>
																		{{substr(ucfirst($squeeb->Job()->first()->squeeb), 0, 40) }}<a href="{{URL::route('squeeb-get',$squeeb->model.'/'.$squeeb->id)}}" >...see more</a>
																		</psquib>
																		
																		@include('member.layouts.share')
																	@else
													
																		<a href="{{URL::route('squeeb-get',$squeeb->model.'/'.$squeeb->id)}}">
																			<div id="mainimg" style="background-image:url({{isset($squeeb->EventsqPhoto()->first()->name) ? 'http://www.squeeber.com/squeeb_photos/'.$squeeb->EventsqPhoto()->first()->name : 'http://www.squeeber.com/squeeb_photos/default.png'}});" >
																			</div>
																		</a>
																		
															
																		
																		<stime>
																			{{HTML::image('images/event.png')}} {{Helpers::displaySqueebTime($squeeb->Eventsq()->first()->created_at)}} - <b>{{' @'.$squeeb->Eventsq()->first()->User()->first()->firstname}}:</b> 
																		</stime>
																		
																		<strong> <a href="{{URL::route('squeeb-get',$squeeb->model.'/'.$squeeb->id)}}">{{$squeeb->Eventsq()->first()->title}}
																		</a>
																		</strong>
																		
																		<psquib>
																		{{substr(ucfirst($squeeb->Eventsq()->first()->squeeb), 0, 40) }}<a href="{{URL::route('squeeb-get',$squeeb->model.'/'.$squeeb->id)}}" >...see more</a>
																		</psquib>
																		
																		@include('member.layouts.share')
																	@endif
																	
																	
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
			   @if(!isset($squeeb)) No Squeebs have been posted. @elseif(!$more) No more Squeebs. @else <a href="{{URL::route('member-more-home',$last_id.'/'.$least_view)}}" > See More </a>@endif
		</div>
@stop
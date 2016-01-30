@extends('guest.layouts.main_header')
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
								
								@include('guest.layouts.college_details')
								
								
								<ul class="services">
								@foreach($newsqueebs as $newsqueeb)
									@if($newsqueeb->model == 'Notice')
										<li><a href="{{URL::route('notice-get',$newsqueeb->Notice()->first()->id)}}" >{{$newsqueeb->Notice()->first()->title}}</a></li>
									@elseif($newsqueeb->model == 'Offer')
										<li><a href="{{URL::route('offer-get',$newsqueeb->Offer()->first()->id)}}" >{{$newsqueeb->Offer()->first()->title}}</a></li>
									@elseif($newsqueeb->model == 'Job')
										<li><a href="{{URL::route('job-get',$newsqueeb->Job()->first()->id)}}" >{{$newsqueeb->Job()->first()->title}}</a></li>
									@else
										<li><a href="{{URL::route('event-get',$newsqueeb->Eventsq()->first()->id)}}" >{{$newsqueeb->Eventsq()->first()->title}}</a></li>
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
																<a href="{{URL::route('notice-get',$squeeb->id)}}">
																	<div id="mainimg" style="background-image:url({{isset($squeeb->NoticePhoto()->first()->name) ? 'http://www.squeeber.com/squeeb_photos/'.$squeeb->NoticePhoto()->first()->name : 'http://www.squeeber.com/squeeb_photos/default.png'}});" >
																	</div>
																</a>
																
													
																
																<stime>
																	{{HTML::image('images/notice.png')}} {{Helpers::displaySqueebTime($squeeb->created_at).' '}} - <b>{{' @'.$squeeb->User()->first()->firstname}}:</b> 
																</stime>
																
																<strong> <a href="{{URL::route('notice-get',$squeeb->id)}}">{{$squeeb->title}}
																</a>
																</strong>
																
																<psquib>
																{{substr(ucfirst($squeeb->squeeb), 0, 40) }}<a href="{{URL::route('notice-get',$squeeb->id)}}">...see more</a>
																</psquib>
																
																@include('guest.layouts.other_share')
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
			   @if(!isset($squeeb)) No Squeebs have been posted. @elseif(!$more) No more Squeebs. @else <a href="{{URL::route('more-home-squeebs',$last_id)}}" > See More </a>@endif
		</div>
		
@stop
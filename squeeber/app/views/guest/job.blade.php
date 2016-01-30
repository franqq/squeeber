@extends('guest.layouts.job_header')
@section('content')

		<div class="wrapper indent">
			<!--Squeeber left side content to display the college details-->
			<aside class="col-4-4">
							<div class="collegeinside">
								@include('guest.layouts.college_details')
								
								<ul class="services">
								@foreach($topsqueebs as $topsqueeb)
										<li><a href="{{URL::route('job-get',$topsqueeb->Job()->first()->id)}}">{{$topsqueeb->Job()->first()->title}}</a></li>
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
												
												<h2 style="text-transform:capitalize;"><span>Jobs and Intenship</span>	
												</h2>
												
												<div class="inner">
												
													 
												 <ul id="contentContainer" class="mysqueeb">
														
														@foreach($squeebs as $squeeb)
														<div class="news-feed">
															<li>
																<a href="{{URL::route('job-get',$squeeb->id)}}">
																	<div id="mainimg" style="background-image:url({{isset($squeeb->JobPhoto()->first()->name) ? 'http://www.squeeber.com/squeeb_photos/'.$squeeb->JobPhoto()->first()->name : 'http://www.squeeber.com/squeeb_photos/default.png'}});" >
																			
																	</div>
																</a>
																
													
																
																<stime>
																	{{HTML::image('images/career.png')}} {{Helpers::displaySqueebTime($squeeb->created_at).' '}} - <b>{{' @'.$squeeb->User()->first()->firstname}}:</b> 
																</stime>
																
																<strong> <a href="{{URL::route('job-get',$squeeb->id)}}">{{$squeeb->title}}
																</a>
																</strong>
																
																<psquib>
																{{substr(ucfirst($squeeb->squeeb), 0, 40) }}<a href="{{URL::route('offer-get',$squeeb->id)}}">...see more</a>
																</psquib>
																
																@include('guest.layouts.other_share')
															</li>
														</div>
													@endforeach
														
												  </ul>
												  
												<script>
												$(document).ready(function(){
												  $("button").click(function(){
												    $.ajax({
												    	url:{{ URL::to('/more/jobs/'.$last_id) }},
												    	success:function(result){
												      	$("#contentContainer").append(result);
												    }});
												  });
												});
												</script>
												  
												
												  
												  
												  
												  <script type="text/javascript">
												  	window.onscroll = function(evt){
													    autoload();
													};
												  </script>
												  
												
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
		   @if(!isset($squeeb)) No Jobs have been posted. @elseif(!$more) No more Jobs.   @else <a href="{{URL::route('more-jobs-get',$last_id)}}" > See More </a>@endif
		  </div>
@stop
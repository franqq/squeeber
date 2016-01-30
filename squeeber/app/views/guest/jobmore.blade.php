	@foreach($squeebs as $squeeb)
		<div class="news-feed">
			<li>
				<a href="{{URL::route('job-get',$squeeb->id)}}">
					
					<div id="mainimg" style="background-image:url({{isset($squeeb->JobPhoto()->first()->name) ? 'squeeb_photos/'.$squeeb->JobPhoto()->first()->name : 'http://www.squeeber.com/squeeb_photos/default.png'}});" >
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
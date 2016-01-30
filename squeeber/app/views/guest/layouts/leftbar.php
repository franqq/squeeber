<div>
<p><h2 style="text-transform:capitalize;" ><span> New </span>@Jkuat</h2></p>
<div>
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
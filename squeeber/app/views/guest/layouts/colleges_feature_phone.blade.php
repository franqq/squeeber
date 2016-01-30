
<div class="collegesfeaturephoneh">Please Select Your College</div>


<div style="width:100%;">
	@foreach($colleges as $college)
	<div class="collegesfeaturephonescreen">
		<div class="mysqueeb">
		<strong><a>{{$college->name}}</a></strong>
		<div class="campusesfeaturephonescreen">
		<ul>
			@foreach($college->Branch()->orderBy('name','ASC')->get() as $campus)
			<li><a href="{{URL::route('selectcampus',$campus->id)}}">{{$campus->name.' Campus'}}</a></li>
			@endforeach
		</ul>
		</div>
		</div>
	</div>
	@endforeach
</div>
<div>
{{HTML::image(isset($college->photo) ? 'logos/'.$college->photo : 'logos/default.png' , '$college->name',array('class' => 'institutionlogo'))}}
{{$college->name}}
</div>
<div style="margin-top: 20px;">
	<br /><br />
	<p class="change-college">
		<a><strong>Trending {{'@'.$college->alias}}, {{$mycampus->name}}</strong></a>
		<a href="{{URL::route('changecampus-get')}}">Change
		{{HTML::image('images/change-college.png','>>')}}</a>
	</p>
<div>
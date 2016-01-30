<div class="countriesmainh">Select Your Country</div>
<div style="width:100%;">
															<div class="countriesmainscreen">
															<ul class="mysqueeb">
																 @foreach($countries as $country)
																 @if($country->id<=38)
																
																	<li>
																		<strong>
																 		 <a href="{{URL::route('selectcountryid',strtolower($country->code))}}">{{$country->alias}}</a>
																 		</strong>
																   </li>
																
																@endif
																@endforeach
															</ul>
															</div>
															
															<div class="countriesmainscreen">
															<ul class="mysqueeb">
																 @foreach($countries as $country)
																 @if($country->id>38 && $country->id<=67)
																
																	<li>
																		<strong>
																 		 <a href="{{URL::route('selectcountryid',strtolower($country->code))}}" >{{$country->alias}}</a>
																 		</strong>
																   </li>
																
																@endif
																@endforeach
															</ul>
															</div> 
															
															
															<div class="countriesmainscreen" >
															<ul class="mysqueeb">
																 @foreach($countries as $country)
																 @if($country->id>67 && $country->id<=115)
																
																	<li>
																		<strong>
																 		 <a href="{{URL::route('selectcountryid',strtolower($country->code))}}" >{{$country->alias}}</a>
																 		</strong>
																   </li>
																
																@endif
																@endforeach
															</ul>
															</div> 
															
															<div class="countriesmainscreen">
															<ul class="mysqueeb">
																 @foreach($countries as $country)
																 @if($country->id>115 && $country->id<=196)
																
																	<li>
																		<strong>
																 		 <a href="{{URL::route('selectcountryid',strtolower($country->code))}}" >{{$country->alias}}</a>
																 		</strong>
																   </li>
																
																@endif
																@endforeach
															</ul>
															</div> 
															
															<div class="countriesmainscreen">
															<ul class="mysqueeb">
																 @foreach($countries as $country)
																 @if($country->id>196 && $country->id<=229)
																
																	<li>
																		<strong>
																 		 <a href="{{URL::route('selectcountryid',strtolower($country->code))}}"  >{{$country->alias}}</a>
																 		</strong>
																   </li>
																
																@endif
																@endforeach
															</ul>
															</div> 
															
															<div class="countriesmainscreen">
															<ul class="mysqueeb">
																 @foreach($countries as $country)
																 @if($country->id>229)
																
																	<li>
																		<strong>
																 		 <a href="{{URL::route('selectcountryid',strtolower($country->code))}}" >{{$country->alias}}</a>
																 		</strong>
																   </li>
																
																@endif
																@endforeach
															</ul>
															</div> 
															
														</div>
				
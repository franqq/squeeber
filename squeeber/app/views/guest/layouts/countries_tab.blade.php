<div class="countriestabh">Select Your Country</div>
														
														<div style="width:100%;">
															<div class="countriestabscreen">
															<ul class="mysqueeb">
																 @foreach($countries as $country)
																 @if($country->id<=65)
																
																	<li>
																		<strong>
																 		 <a href="{{URL::route('selectcountryid',strtolower($country->code))}}">{{$country->alias}}</a>
																 		</strong>
																   </li>
																
																@endif
																@endforeach
															</ul>
															</div>
															
															<div class="countriestabscreen">
															<ul class="mysqueeb">
																 @foreach($countries as $country)
																 @if($country->id>65 && $country->id<=164)
																
																	<li>
																		<strong>
																 		 <a href="{{URL::route('selectcountryid',strtolower($country->code))}}" >{{$country->alias}}</a>
																 		</strong>
																   </li>
																
																@endif
																@endforeach
															</ul>
															</div> 
															
															
															<div class="countriestabscreen" >
															<ul class="mysqueeb">
																 @foreach($countries as $country)
																 @if($country->id>164 && $country->id<=208)
																
																	<li>
																		<strong>
																 		 <a href="{{URL::route('selectcountryid',strtolower($country->code))}}" >{{$country->alias}}</a>
																 		</strong>
																   </li>
																
																@endif
																@endforeach
															</ul>
															</div> 
															
															
														
														
															<div class="countriestabscreen">
															<ul class="mysqueeb">
																 @foreach($countries as $country)
																 @if($country->id>208)
																
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
														
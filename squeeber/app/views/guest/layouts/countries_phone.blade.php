		<div class="countriesphoneh">Select Your Country</div>
														
														<div style="width:100%;">
															<div class="countriesphonescreen">
															<ul class="mysqueeb">
																 @foreach($countries as $country)
																 @if($country->id<=ceil($countries->last()->id/2))
																
																	<li>
																		<strong>
																 		 <a href="{{URL::route('selectcountryid',strtolower($country->code))}}">{{$country->alias}}</a>
																 		</strong>
																   </li>
																
																@endif
																@endforeach
															</ul>
															</div>
															
															
															
															
														
														
															<div class="countriesphonescreen">
															<ul class="mysqueeb">
																 @foreach($countries as $country)
																 @if($country->id>ceil($countries->last()->id/2))
																
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
		<div class="countriesfeaturephoneh">Select Your Country</div>
														
														<div style="width:100%;">
															<div class="countriesfeaturephonescreen">
															<ul class="mysqueeb">
																 @foreach($countries as $country)
																 
																
																	<li>
																		<strong>
																 		 <a href="{{URL::route('selectcountryid',strtolower($country->code))}}">{{$country->alias}}</a>
																 		</strong>
																   </li>
																
																
																@endforeach
															</ul>
															</div>
															
															
															
														</div>
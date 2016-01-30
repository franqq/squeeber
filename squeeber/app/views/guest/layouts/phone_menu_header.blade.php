					<div class='response-menu'>
						<div>{{HTML::image('images/menu2.png','menu')}}</div>
						<select onChange="location=this.value">
							<option></option>
							<option value="{{URL::route('home')}}">College Home</option>
							<option value="{{URL::route('events-get')}}">College Events</option>
							<option value="{{URL::route('offers-get')}}">College Classifieds</option>
							<option value="{{URL::route('jobs-get')}}">College Jobs</option>
						</select>
					</div>
				</nav>
			</div>
			
		</header>
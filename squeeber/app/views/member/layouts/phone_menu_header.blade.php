					<div class='response-menu'>
						<div>{{HTML::image('images/menu2.png','menu')}}</div>
						<select onChange="location=this.value">
							<option></option>
							<option value="{{URL::route('member-home')}}">Home</option>
							<option value="{{URL::route('notices-get')}}">College Stories</option>
							<option value="{{URL::route('events-get')}}">College Events</option>
							<option value="{{URL::route('offers-get')}}">College Classifieds</option>
							<option value="{{URL::route('jobs-get')}}">College Jobs</option>
							<option value="{{URL::route('newcollege-get')}}">Settings</option>
							
						</select>
					</div>
				</nav>
			</div>
			
		</header>
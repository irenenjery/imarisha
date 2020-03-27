<div class="w3-content w3-padding" id="welcome-content" style="">
  <!-- Schedule Section -->  
  <section class="" id="">
  	<h2>Almost there...</h2>
    <h4 class="w3-center">We just need a little more info to better your experience at&nbsp;&nbsp;<span class="selected_prog w3-padding"><b>IM</b></span></h4>

    <div class="w3-container w3-card w3-white" style="width: 70%; margin: auto;">
    	<form class="w3-padding" name="details_form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" name="details" id="details-form">
    		<p>
    			<h4>Gender:</h4>
    			<label for="m">
	    			<div class="w3-half">
			    		<input type="radio" name="gender" value="m" id="m" required>&nbsp;
			    		Male
	    			</div>
    			</label>
    			<label for="f">
	    			<div class="w3-half">
			    		<input type="radio" name="gender" value="f" id="f" required>&nbsp;
			    		Female
	    			</div>
	    		</label>
	    	</p>
    		<p style="display: inline-block;">
    			<h4>Date of Birth: <i class="w3-small">(ages 18 - 50 years)</i></h4>
    			<div>
    				<input type="date" name="dob" id="dob" style="width: 100%" max="<?php echo date('Y-m-d', strtotime('-18 years')) ?>" min="<?php echo date('Y-m-d', strtotime('-50 years')) ?>" required>
    			</div>
	    	</p>
    		<p style="display: inline-block;margin-top: -40px">
  				<h5>How often do you visit a gym?</h5>
	        <ul id="exp_list" style="list-style-type: none;">
	          <label for="beginner">
	            <li class="exp w3-hover-shadow w3-panel w3-padding w3-white w3-border w3-border-green">
	              <h4>
	              	<input type="radio" name="exp" value="beginner" id="beginner" checked >
	              		&nbsp;Never been to a gym.
	              </h4>
	            </li>
	          </label>
	          <label for="intermediate">
	            <li class="exp w3-hover-shadow w3-panel w3-padding w3-white w3-border w3-border-green">
	              <h4>
	              	<input type="radio" name="exp" value="intermediate" id="intermediate" >
	              		&nbsp;I go on occassion.
	              </h4>
	            </li>
	          </label>
	          <label for="advanced">
	            <li class="exp w3-hover-shadow w3-panel w3-padding w3-white w3-border w3-border-green">
	              <h4>
	              	<input type="radio" name="exp" value="advanced" id="advanced" >
	              		&nbsp;Am a regular at the gym.
	              </h4>
	            </li>
	          </label>
	        </ul>
	    	</p>
    		<p style="padding-top: 20px ">
    			<h5>Any physical or health complications?</h5>
	    		<label for="false">
	    			<div class="w3-half">
			    		<input type="radio" name="complications" value="false" id="false" onclick="toggleTextarea(false)" checked>&nbsp;
			    		No
	    			</div>
	    		</label>
	    		<label for="true">
	    			<div class="w3-half">
			    		<input type="radio" name="complications" value="true" id="true" onclick="toggleTextarea(true)">&nbsp;
			    		Yes
	    			</div>
	    		</label>
    			<div style="display: none;margin-top: 10px;" id="comp_descr_container">
    				<textarea class="w3-padding" name="comp_descr" id="comp_descr" rows="5" cols="50" placeholder="List them here"></textarea>
    			</div>
	    	</p>
				<p style="padding-top: 50px">
				  <button type="submit" class="w3-btn-block w3-teal w3-large">Register</button>
				</p>
    	</form>
    </div>
	</section>
</div>
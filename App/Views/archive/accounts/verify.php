<div class="row resume">
	<div class="medium-12 columns">
		<p>
		<?php 
				if($verified)
					echo 'You have been verified!';
				else if(!$exist)
					echo 'This user does not exist';
		?>
		</p>
		<p>You can now sign into your area! Will be redirected in 5 seconds back to home. If you are not redirected click <a href="/">here</a>
	</div>
</div>
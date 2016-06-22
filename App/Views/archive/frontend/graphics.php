<div class="row">
	<div class="medium-12 columns">
		<div id="pageHead" class="row">
			<div class="medium-12 columns">
				<h2>Gabriele Nunez</h2>
				<h1>Graphics</h1>
			</div>
		</div>
		<div class="row">
			<div class="small-12 columns">
				<?php
					if(count($lqImages)){
						echo '<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-3">';
						foreach($lqImages as $index =>  $lqImage) {
							echo '	<li>
										<img class="gallery-image" src="'.$lqImage.'" title="Gallery Image '.$index.'" alt="Gallery Image '.$index.'" />
									</li>';
						}
						echo '</ul>';
					} else{
						echo '<p style="display:black;text-align:center">Coming Soon!</p>';
					}
				?>
			</div>
		</div>
	</div>
</div>
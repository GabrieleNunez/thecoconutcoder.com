<div class="row">
	<div class="medium-12 columns">
		<div id="pageHead" class="row">
			<div class="medium-12 columns">
				<h2>Gabriele Nunez</h2>
				<h1>Software</h1>
			</div>
		</div>
		<div class="row">
			<?php
				$flag = 0;
				$cycle = 3;
				if(count($softwares)){
					foreach($softwares as $software){
						if($flag == $cycle){
							echo '</div><div class="row">';
							$flag = 0;
						}
						echo '<div class="medium-4 columns software">
								<div class="row">
									<div class="medium-12 columns">
										<h2>'.$software->title.'</h2>
									</div>
								</div>
								<div class="row">
									<div class="medium-12 columns">
										<p>'.$software->description.'</p>
										<a class="button large" target="_blank" href="'.$software->link.'">View on Github</a>
									</div>
								</div>
							 </div>';
						$flag++;
					}
				} else{
					echo '<p style="display:black;text-align:center">Coming Soon!</p>';
				}
			?>
		</div>
	</div>
</div>
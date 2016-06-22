<div class="row resume">
	<div class="medium-12 columns">
		<div id="pageHead" class="row">
			<div class="medium-12 columns">
				<h2>Gabriele Nunez</h2>
				<h1>Resume</h1>
			</div>
		</div>
		<div class="row contact-info">
				<div class="medium-12 columns">
					<p>Name: Gabriele M. Nunez</p>
					<p class="hide-printing">Email: <a href='mailto:gabrielenunez@thecoconutcoder.com'>gabrielenunez@thecoconutcoder.com</a></p>
					<p class="show-printing">Email: gabrielenunez@thecoconutcoder.com</p>
					<p>Phone: 203-999-7014</p>
				</div>
			</div>
			<div class="row">
				<div class="medium-12 columns">
					<h2>Summary</h2>
				</div>
			</div>
			<div class="row">
				<div class="medium-12 columns">
					<p>
						Highly driven and self-motivating individual with strong background in computers and 
						customer service. 
						I have a solid 5+ years programming across multiple hobbyist projects and another 
						2 years of Customer Service. Attending school with a strong drive toward a bachelors in
						Computer Science. If you’re interested in seeing my projects they can be found here: 
						<a class="hide-printing" href='http://github.com/GabrieleNunez'>http://github.com/GabrieleNunez</a>
						<span class="show-printing">http://github.com/GabrieleNunez</span>
					 </p>
				 </div>
			 </div>
			 <div class="row">
			 	<div class="medium-12 columns">
			 		<h2>Experience</h2>
			 	</div>
			 </div>
			 <div class="row experience">
			 	<div class="medium-4 columns">
			 		<div class="row">
			 			<div class="medium-12 columns">
			 				<h3>Languages</h3>
			 			</div>
			 		</div>
			 		<div class="row">
			 			<div class="medium-12 columns">
				 			<ul>
				 				<?php
				 					foreach($resume->languages as $language){
				 						echo '<li>'.$language->name.'</li>';
				 					}
				 				?>
				 			</ul>
			 			</div>
			 		</div>
			 	</div>
			 	<div class="medium-4 columns">
			 		<div class="row">
			 			<div class="medium-12 columns">
			 				<h3>Frameworks/Tech</h3>
			 			</div>
			 		</div>
			 		<div class="row">
			 			<div class="medium-12 columns">
				 			<ul>
				 				<?php
				 					foreach($resume->frameworks as $tech){
				 						echo '<li>'.$tech->name.'</li>';
				 					}
				 				?>
				 			</ul>
			 			</div>
			 		</div>
			 	</div>
			 	<div class="medium-4 columns">
			 		 <div class="row">
			 			<div class="medium-12 columns">
			 				<h3>Software</h3>
			 			</div>
			 		</div>
			 		<div class="row">
			 			<div class="medium-12 columns">
				 			<ul>
				 				<?php
				 					foreach($resume->softwares as $software){
				 						echo '<li>'.$software->name.'</li>';
				 					}
				 				?>
				 			</ul>
			 			</div>
			 		</div>
			 	</div>
			 </div>
		</div>
	</div>
</div>
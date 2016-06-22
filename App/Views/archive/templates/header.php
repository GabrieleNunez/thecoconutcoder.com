<?php use Library\View; ?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title; ?></title>
		<meta charset="UTF-8">
		<meta name="author" content="Gabriele M. Nunez">
		<meta name="description" content="Freelance Programmer and Graphic Artist">
		<meta name="keywords" content="Gabriele,M,Nunez,Michael,Programmer,Graphic,Art,Design,Web,Designer">
        <meta name="google-site-verification" content="9CmIzec76ndQQshu78Es8abN6gHXt9hmZK-T2y7in7M" />
		<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
		<link href="/CoconutCoderFavicon.png" rel="icon" type="image/png" />
		<link rel="apple-touch-icon" href="/CoconutCoderFavicon.png" />
		<link href="/css/normalize.css" rel="stylesheet" />
		<link href="/css/foundation.css" rel="stylesheet" />
		<link href="/css/global.css" rel="stylesheet" />
	</head>
	<body>
		<nav class="top-bar contain-to-grid hide-for-medium-up" data-topbar role="navigation">
			<ul class="title-area">
				<li class="name">
					<h1><a href="/">The Coconut Coder</a></h1>
				</li>
				<li class="toggle-topbar menu-icon">
					<a href="#"><span></span></a>
				</li>
			</ul>
			<section class="top-bar-section">
				<?php echo View::make('templates/nav.php')->with('maintab',$maintab); ?>
			</section>
		</nav>
		<div id="content">
			<div id="header" class="show-for-medium-up">
				<div class="row">
					<div class="medium-12 columns">
						<div id="navlinks">
							<?php echo View::make('templates/nav.php')->with('maintab',$maintab); ?>
							<?php echo View::make('templates/social.php'); ?>
						</div>
					</div>
				</div>
			</div>

<html>
	<head>
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<title><?php if (isset($PAGE_TITLE)) echo $PAGE_TITLE; else echo 'SHOW';?></title>
		<link rel='stylesheet' type='text/css' href='styles/global_styles.css.php'>
		<link rel='stylesheet' type='text/css' href='styles/tooltip.css'>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
		<script type='text/javascript' src='scripts/global.js'></script>
		<script type='text/javascript' src='scripts/graph_navBar.js'></script>
		<script type='text/javascript' src='scripts/nav_selections.js'></script>
		<?php if (isset($HTML_HEADER)) echo $HTML_HEADER;?>
	</head>
	<body>
		<!-- Header -->
		<div id='fixedHead'>
			<div id='title'>
				<a href='http://hal.pratt.duke.edu'>
					<img id='halLogo' src='images/hal_light.png'>
				</a>
				<h1 style='padding: 40px 290px;'>Simulator of Humans and Automation in Dispatch Operatorations</h1>
			</div>

			<!-- Navigation -->
			<nav id='topNav' class='hide'>
				<ul>
					<li><a href='index.php'>Home</a></li>
					<li><a href='basic_settings.php'>Run Simulation</a></li>
					<li><a href='contact_us.php'>Contact Us</a></li>
					<li style='float: right'><a href='version_history.php'>Version</a></li>
				<?php if (Util::$DEBUG): ?>
					<li style='float: right; background-color: pink;'>
						<a href='#' onclick='window.open("callPHP?f=print_r&a=$GLOBALS")'>
							Print
						</a>
					</li>
					<li style='float: right; background-color: red;'>
						<a href='#' onclick='window.open("callPHP?f=Util::clearSession"); location.reload();'>
							Reset
						</a>
					</li>
				<?php endif ?>
				</ul>
			</nav>
		</div>

		<!-- Page body -->
		<div id='fixedBody'></div>
		<div id='main'>
			<input id='assistant_info' value='2' type='hidden'>

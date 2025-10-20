<!DOCTYPE HTML>
<html>

<head>
	<?php
	print($head);
	?>
	<meta hx-preserve="true" name="viewport" content="width=device-width, initial-scale=1" />
	<!--<meta name="viewport" content="width=device-width, user-scalable=no">-->
	<meta hx-preserve="true" http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta hx-preserve="true" name="author" content="Sander Teunissen">
	<meta hx-preserve="true" content="utf-8" http-equiv="encoding" /> <link hx-preserve="true" rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" /> <link hx-preserve="true" rel="stylesheet" href="css/site.css" media="all" />
	<script hx-preserve="true" src="scripts/htmx-2.0.6.min.js"></script>
	<script hx-preserve="true" src="scripts/page.js"></script>
	<script hx-preserve="true" src="scripts/htmx-head-support-2.0.2.min.js"></script>

</head>
<div id="darkmode-toggle"></div>

<body hx-ext="head-support" <?php if ($dark_mode) {
					print("class='dark'");
				} else {
					print("class='light'");
				}	?>>
<a href="#content" id="skiplink">Skip to content</a>
	<div id="header">
		<p>Sander Teunissen</p>
	</div>
	<div id="nav" hx-boost="true" hx-target="#content" hx-swap="show:none">
		<ul id="navigation">
			<?php
			foreach ($route_list as $key => $value) {
				if (!$value->hide_from_menu) {
					print('<li><a href="' . $value->routes[0]);
					if ($dark_mode) {
						print("?dark_mode=1");
					}
					print('">' . $value->name . '</a></li> ');
				}
			}
			?>
		</ul>
	</div>
	<div id="container">
		<div id="content">
			<?php print($body); ?>
		</div>
	</div>
</body>

</html>

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
	<meta hx-preserve="true" content="utf-8" http-equiv="encoding" />
	<link hx-preserve="true" rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
	<link hx-preserve="true" rel="stylesheet" href="css/site.css" media="all" />
	<link hx-preserve="true" rel="stylesheet" href="/fontawesome/css/all.css" media="all" />
	<script hx-preserve="true" src="scripts/htmx-2.0.6.min.js"></script>
	<script hx-preserve="true" src="scripts/page.js"></script>
	<script hx-preserve="true" src="scripts/htmx-head-support-2.0.2.min.js"></script>

</head>

<body hx-ext="head-support" <?php if (isset($_GET['dark_mode']) && $dark_mode) {
								print("class='dark'");
							} elseif (isset($_GET['dark_mode'])) {
								print("class='light'");
							}	?>>
	<a href="#content" id="skiplink">Skip to content</a>
	<div id="header">
		<div id="language-selection">
			<a href="?language=nl"
				hx-target="#content"
				hx-swap="show:none"
				hx-boost="true"
				hx-on::after-request="clearActiveLanguage();this.className='active'"
				<?php if ($language == "nl") {
					print("class='active'");
				} 	?>>NL</a>
			|
			<a href="?language=en"
				hx-target="#content"
				hx-swap="show:none"
				hx-boost="true"
				hx-on::after-request="clearActiveLanguage();this.className='active'"
				<?php if ($language == "en") {
					print("class='active'");
				} 	?>>EN</a>
			|
			<a href="<?php
						print($route);
						if (!$dark_mode) {
							print("?dark_mode=1");
						} ?>" id="darkmode-toggle" alt="darkmode-toggle">
				<i class="fa-regular fa-sun hidden-lightmode" alt="light mode" title="light mode"></i>
				<i class="fa-regular fa-moon hidden-darkmode" alt="dark mode" title="dark mode"></i>
			</a>
		</div>
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
	<div id="footer">
		<a href="mailto:sander@fam-teunissen.nl" target="_blank">
			<i class="fa-solid fa-envelope"></i>
			E-mail
		</a>
		|
		<a href="https://www.linkedin.com/pub/sander-teunissen/49/930/b69" target="_blank">
			<i class="fa-brands fa-linkedin"></i>
			Linkedin
		</a>
		|
		<a href="https://github.com/tbloody">
			<i class="fa-brands fa-github"></i>
			GitHub
		</a>
	</div>
</body>

</html>

<?php

$redirect_url = '/project/index.php'; 

if (isset($_SESSION['rights'])) {
    if ($_SESSION['rights'] == 103) {
        $redirect_url = '/project/admin/home_admin.php';
    } else {
        $redirect_url = '/project/home.php';
    }
}

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GildedHook</title>
    <link rel="stylesheet" href="/project/frontend/style.css">
    <link rel="icon" type="image/x-icon" href="/project/images/yarnballlogolilac.png">
    <script src="/project/scripts/cookie.js" type="text/javascript" charset="UTF-8"></script>
    <script type="text/javascript" src="//www.termsfeed.com/public/cookie-consent/4.2.0/cookie-consent.js&quot; charset="UTF-8"></script>
    <script src="/project/scripts/sidebar_toggle.js"></script>
    <script src="/project/scripts/confirm_deletion.js"></script>
    <script src="/project/scripts/home_text.js"></script>
    <script src="/project/scripts/password_visibility.js"></script>
    <script src="/project/scripts/api_quote.js"></script>
	<script src="/project/scripts/choose_language.js"></script>
	<script src="/project/scripts/delete_image.js"></script>
	<script src="/project/scripts/cookie.js"></script>
	<script src="https://unpkg.com/react@16/umd/react.development.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js" crossorigin></script>
    <script src="https://unpkg.com/babel-standalone@6.26.0/babel.js"></script>
	<script src="/project/scripts/REACT.js" type="text/babel"></script>
</head>
<body>   
  	<header>
    	<nav class="navbar">
			<div class="navbar-container">
				<div class="navbar-intro">
					<a href="<?= $redirect_url ?>" class="logolink">
					<img src="/project/images/yarnballlogoblacksmall.png" class="catlogo">
					<div id="title"></div>
					<!--<h1 class="navbar-logo intro">GILDEDHOOK</h1>-->
					</a>
				</div>

        		<div class="rightnav">
          			<div class="lang-menu">
            			<div class="selected-lang">
              				<?= lang('Nyelv') ?>
            			</div>
						<ul>
						<li>
							<a href="#" class="hu" data-lang="hu">Magyar</a>
						</li>
						<li>
							<a href="#" class="en" data-lang="en">English</a>
						</li>
						</ul>   
          			</div>
        		</div>
      		</div>
    	</nav>
  	</header>
</body>
</html>
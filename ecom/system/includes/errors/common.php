<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
	<!-- Encoding -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="fr" />
	
	<!-- Title -->
	<title>GONAM : Erreur</title>
	
	<!-- Meta Tags -->
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	
	<!-- Favicon -->
	<link rel="icon" href="./public/imgs/favicon.ico" />
	
	<!-- CSS -->
	<!-- Reset CSS (normalize.css) -->
	<link href="./public/css/normalize.css" rel="stylesheet" type="text/css" />
	<link href="./public/css/grid.css" rel="stylesheet" type="text/css" />
	<link href="./public/css/style-ecom.css" rel="stylesheet" type="text/css" />
	
	<!--<meta http-equiv="refresh" content="3;URL=<?php echo urlencode($url); ?>" />--> 
</head>
<body style="background:#fefefe">
	
	<div style="width:70%;min-width:960px;margin:10% auto 0 auto;">
		<div id="ntc">
			<div id="logo"><div style="background-color:#d9d9d9;border-radius:5px;" class="ecom-logo"></div></div>
			<h1>Oops ... <?php echo intval($code); ?></h1>
			<div class="notice error"><p><?php echo htmlentities($notice); ?></p></div>
			<div class="redirect">
				<p class="txtcenter">Vous allez être redigé automatiquement dans quelques secondes, sinon <a href="index.php">cliquez-ici</a>.</p>
			</div>
		</div>
	</div>
	
</body>
</html>

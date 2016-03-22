<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="fr" />
	
	<title>GONAM - Ventes de produits électroniques</title>
	
	<meta name="author" content="Candia Nicolas" />
	<link rel="icon" href="./public/imgs/favicon.ico" />
	
	<link href="./public/css/normalize.css" type="text/css" rel="stylesheet" />
	<link href="./public/css/grid.css" type="text/css" rel="stylesheet" />
	<link href="./public/css/style-ecom.css" type="text/css" rel="stylesheet" />
	
	<script src="./public/js/jquery.min.js" type="text/javascript"></script>
	<!--<script src="./js/ecom.js" type="text/javascript"></script>-->
</head>
<body>

	<header>
		<div id="top-bar"><div id="top-wrap">
			<div class="edito"><p>GONAM, site de ventes de produits électroniques numériques.</p></div>
			<div id="account-wrap">
				<?php if (isLogin()) { ?>
				<span>Bonjour <?php echo htmlentities(getSessionItem('user')); ?> - <a href="<?php echo getURL('account', 'logout'); ?>">déconnexion</a></span>
				<?php } else { ?>
				<a href="<?php echo getURL('account', 'login'); ?>" class="top-link">Connexion</a>
				<a href="<?php echo getURL('account', 'register'); ?>" class="top-link">S'inscrire</a>
				<?php } ?>
				<a href="<?php echo getURL('cart'); ?>" class="top-link ecom-ic cart"><?php echo intval(countArticleInCart()); ?> article(s)</a>
			</div>
		</div></div>
		<div id="header"><div id="header-wrap">
			<div id="logo"><a href="<?php echo getURL('home'); ?>" class="ecom-logo"></a></div>
		</div></div>
	</header>

	<section>
		<div id="main-wrap" class="row-spaced">
			<div class="col tiny">
			<?php include_once(APPPATH . '/views/nav.php'); ?>
			</div>
			<div class="col huge">
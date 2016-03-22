<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="fr" />
	
	<title>GONAM - Control panel</title>
	
	<meta name="author" content="Candia Nicolas" />
	<link rel="icon" href="./public/imgs/favicon.ico" />
	
	<link href="./public/css/normalize.css" type="text/css" rel="stylesheet" />
	<link href="./public/css/style.css" type="text/css" rel="stylesheet" />
	
	<script src="./public/js/jquery.min.js" type="text/javascript"></script>
	<script src="./public/js/ecom.js" type="text/javascript"></script>
</head>
<body>

	<div id="main_wrap">
		<div id="header_wrap">
			<div id="h_account"><p>Bienvenue, <b><?php echo htmlentities(getSessionItem('user')); ?></b> [ <a href="<?php echo getURL('account', 'logout'); ?>">déconnexion</a> ]</p></div>
		</div>
		
		<?php include(APPPATH . 'views/admin_nav.php'); ?>
		
		<div id="data_wrap">
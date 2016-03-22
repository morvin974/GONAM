<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/head.php');
?>

<div class="title">Connexion</div>
<p>Pour vous authentifier sur le site veuillez remplir le formulaire ci-dessous.</p>

<?php if (hasErrorForm()) { ?>
	<div class="notice error"><?php echo getErrorForm(); ?></div>
<?php } ?>
		
<?php if ($error != '') { ?>
	<div class="notice error"><p><?php echo $error; ?></p></div>
<?php } ?>
	
<form action="<?php echo getURL('account', 'login'); ?>" method="post">
	<div>
		<label for="email">E-mail</label>
		<input type="text" name="user_mail" id="email" maxlength="124" placeholder="ex@example.com" />
	</div>

	<div>
		<label for="password">Mot de passe</label>
		<input type="password" name="user_password" id="password" maxlength="32" />
	</div>
	
	<div class="form-action txtcenter">
		<input type="submit" class="green" value="Se connecter" />
	</div>
</form>

<?php include(APPPATH . 'views/foot.php'); ?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/head.php');
?>

<div class="title">Inscription</div>
<p>Pour vous inscrire sur le site veuillez remplir le formulaire ci-dessous.</p>

<?php if (hasErrorForm()) { ?>
	<div class="notice error"><?php echo getErrorForm(); ?></div>
<?php } ?>
		
<?php if ($error != '') { ?>
	<div class="notice error"><p><?php echo $error; ?></p></div>
<?php } ?>
		
<form action="<?php echo getURL('account', 'register'); ?>" method="post">
	<div class="title">Information de connexion</div>
	
	<div>
		<label for="email">E-mail</label>
		<input type="text" name="user_mail" id="email" maxlength="124" value="<?php echo getPostData('user_mail'); ?>" placeholder="ex@example.com" />
	</div>

	<div>
		<label for="password">Mot de passe</label>
		<input type="password" name="user_password" id="password" maxlength="32" />
	</div>
	
	<div>
		<label for="confpwd">Confirmer</label>
		<input type="password" name="pwdconfirm" id="confpwd" maxlength="32" />
	</div>
	
	<div class="title">Information général</div>
	
	<div>
		<label for="name">Nom</label>
		<input type="text" name="user_name" value="<?php echo getPostData('user_name'); ?>" id="name" maxlength="32" />
	</div>
	
	<div>
		<label for="firstname">Prénom</label>
		<input type="text" name="user_firstname" id="firstname" maxlength="32" value="<?php echo getPostData('user_firstname'); ?>" />
	</div>
	
	<div>
		<label for="birthday">Date de naissance</label>
		<input type="text" name="user_birthday" id="birthday" size="10" maxlength="10" placeholder="JJ/MM/AAAA" value="<?php echo getPostData('user_birthday'); ?>" />
	</div>
	
	<div>
		<label for="gender">Sexe</label>
		<select name="user_gender" id="gender">
			<option value="H">Homme</option>
			<option value="F">Femme</option>
		</select>
	</div>
	
	<div class="form-action txtcenter">
		<input type="submit" class="green" value="Confirmer l'inscription" />
	</div>
</form>

<?php include(APPPATH . 'views/foot.php'); ?>
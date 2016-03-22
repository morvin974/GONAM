<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/admin_head.php');
?>

<div class="data_box">
	<div class="d_title"><p>Gestion des utilisateurs</p></div>
	<div class="d_content">
		<?php if (hasErrorForm()) { ?>
		<div class="notice error"><?php echo getErrorForm(); ?></div>
		<?php } ?>
		
		<?php if ($error != '') { ?>
		<div class="notice error"><p><?php echo $error; ?></p></div>
		<?php } ?>
		
		<form action="<?php echo getURL('users', 'edit', array('id' => $userData['id_user'])); ?>" method="post">
			<label for="umail">E-mail</label>
				<input type="text" name="uemail" id="umail" size="32" maxlength="124" value="<?php echo htmlentities($userData['user_mail']); ?>" readonly /><br />
			
			<label for="upwd">Mot de passe</label>
				<input type="password" name="upwd" id="upwd" size="24" maxlength="32" value="hello" /><br />
				
			<label for="ucfm">Confirmer</label>
				<input type="password" name="ucfm" id="ucfm" size="24" maxlength="32" value="hello" /><br />
			
			<label for="ugroup">Groupe</label>
				<select name="ugroup" id="ugroup">
				<?php foreach ($groups as $group) { ?>
				<option value="<?php echo $group['id_group']; ?>"><?php echo htmlentities($group['group_name']); ?></option>
				<?php } ?>
				</select><br />
			<hr />
			
			<label for="ufirst">Nom</label>
				<input type="text" name="ufirst" id="ufirst" size="24" maxlength="32" value="<?php echo htmlentities($userData['user_firstname']); ?>" /><br />
				
			<label for="uname">Prénom</label>
				<input type="text" name="uname" id="uname" size="24" maxlength="32" value="<?php echo htmlentities($userData['user_name']); ?>" /><br />
				
			<label for="ubrith">Date de naissance</label>
				<input type="text" name="ubirth" id="ubrith" size="12" value="<?php echo htmlentities($userData['user_birthday']); ?>" placeholder="aaaa-mm-jj" /><br />
				
			<label for="ugender">Sexe</label>
				<select name="ugender" id="ugender">
					<option value="homme">Homme</option>
					<option value="femme">Femme</option>
					<option value="autre">Autre</option>
				</select><br />
		
			<div class="form_action">
				<a href="<?php echo getURL('users'); ?>" class="d_button">Retour</a>
				<input type="submit" value="Modifier" />
			</div>
		</form>
	</div>
</div>

<?php include(APPPATH . 'views/admin_foot.php'); ?>
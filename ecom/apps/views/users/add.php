<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/admin_head.php');
?>

<div class="data_box">
	<div class="d_title"><p>Ajout d'un utilisateur</p></div>
	<div class="d_content">
		<?php if (hasErrorForm()) { ?>
		<div class="notice error"><?php echo getErrorForm(); ?></div>
		<?php } ?>
		
		<?php if ($error != '') { ?>
		<div class="notice error"><p><?php echo $error; ?></p></div>
		<?php } ?>
		
		<form action="<?php echo getURL('users', 'add'); ?>" method="post">
			<label for="umail">E-mail</label>
				<input type="text" name="uemail" id="umail" size="32" maxlength="124" /><br />
			
			<label for="upwd">Mot de passe</label>
				<input type="password" name="upwd" id="upwd" size="24" maxlength="32" /><br />
				
			<label for="ucfm">Confirmer</label>
				<input type="password" name="ucfm" id="ucfm" size="24" maxlength="32" /><br />
			
			<label for="ugroup">Groupe</label>
				<select name="ugroup" id="ugroup">
				<?php foreach ($groups as $group) { ?>
				<option value="<?php echo $group['id_group']; ?>"><?php echo htmlentities($group['group_name']); ?></option>
				<?php } ?>
				</select><br />
			<hr />
			
			<label for="ufirst">Nom</label>
				<input type="text" name="ufirst" id="ufirst" size="24" maxlength="32" /><br />
				
			<label for="uname">Prénom</label>
				<input type="text" name="uname" id="uname" size="24" maxlength="32" /><br />
				
			<label for="ubrith">Date de naissance</label>
				<input type="text" name="ubirth" id="ubrith" size="12" placeholder="aaaa-mm-jj" /><br />
				
			<label for="ugender">Sexe</label>
				<select name="ugender" id="ugender">
					<option value="H">Homme</option>
					<option value="F">Femme</option>
				</select><br />
		
			<div class="form_action">
				<a href="<?php echo getURL('users'); ?>" class="d_button">Retour</a>
				<input type="submit" value="Ajouter" />
			</div>
		</form>
	</div>
</div>

<?php include(APPPATH . 'views/admin_foot.php'); ?>
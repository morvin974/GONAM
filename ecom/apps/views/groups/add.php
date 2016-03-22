<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/admin_head.php');
?>

<div class="data_box">
	<div class="d_title"><p>Ajout d'un groupe</p></div>
	<div class="d_content">
		<p>Pour ajouter un groupe au site, veuillez remplir l'ensemble des champs ci-dessous.</p>
		<hr />
		<?php if (hasErrorForm()) { ?>
		<div class="notice error"><?php echo getErrorForm(); ?></div>
		<?php } ?>
		
		<form action="<?php echo getURL('groups', 'add'); ?>" method="post">
			<label for="gname">Nom du groupe</label>
				<input type="text" name="name" id="gname" maxlength="24" size="24" /><br />
				
			<label for="glevel">Niveau d'accès</label>
				<input type="text" name="level" id="glevel" maxlength="3" size="4" />
		
			<div class="form_action">
				<a href="<?php echo getURL('groups'); ?>" class="d_button">Retour</a>
				<input type="submit" value="Ajouter" />
			</div>
		</form>
	</div>
</div>

<?php include(APPPATH . 'views/admin_foot.php'); ?>
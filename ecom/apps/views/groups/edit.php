<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/admin_head.php');
?>

<div class="data_box">
	<div class="d_title"><p>Gestion des groupes</p></div>
	<div class="d_content">
		<?php if (hasErrorForm()) { ?>
		<div class="notice error"><?php echo getErrorForm(); ?></div>
		<?php } ?>
		<?php if ($success) { ?>
		<div class="notice success"><p>Modification(s) sauvegardée(s)</p></div>
		<?php } ?>
		<form action="<?php echo getURL('groups', 'edit', array('id' => $group['id_group'])); ?>" method="post">
			<label for="gname">Nom du groupe</label>
				<input type="text" name="name" id="gname" maxlength="24" value="<?php echo htmlentities($group['group_name']); ?>" size="24" /><br />
				
			<label for="glevel">Niveau d'accès</label>
				<input type="text" name="level" id="glevel" maxlength="3" value="<?php echo $group['group_privileges']; ?>" size="4" />
		
			<div class="form_action">
				<a href="<?php echo getURL('groups'); ?>" class="d_button">Retour</a>
				<input type="submit" value="Modifier" />
			</div>
		</form>
	</div>
</div>

<?php include(APPPATH . 'views/admin_foot.php'); ?>
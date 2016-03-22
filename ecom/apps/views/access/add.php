<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/admin_head.php');
?>

<div class="data_box">
	<div class="d_title"><p>Ajout d'un accès</p></div>
	<div class="d_content">
		<?php if (hasErrorForm()) { ?>
		<div class="notice error"><?php echo getErrorForm(); ?></div>
		<?php } ?>
		
		<form action="<?php echo getURL('access', 'add'); ?>" method="post">
			<label for="page">Page</label>
				<input type="text" name="page" id="page" maxlength="24" size="24" /><br />
				
			<label for="plevel">Niveau requis</label>
				<input type="text" name="level" id="plevel" maxlength="3" size="4" />
		
			<div class="form_action">
				<a href="<?php echo getURL('access'); ?>" class="d_button">Retour</a>
				<input type="submit" value="Ajouter" />
			</div>
		</form>
	</div>
</div>

<?php include(APPPATH . 'views/admin_foot.php'); ?>
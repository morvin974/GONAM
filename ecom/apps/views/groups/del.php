<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/admin_head.php');
?>

<div class="data_box">
	<div class="d_title"><p>Gestion des groupes</p></div>
	<div class="d_content">
		
		<form action="<?php echo getURL('groups', 'del', array('id' => $group['id_group'])); ?>" method="post">
			<input type="hidden" name="hidden_confirm" value="uselessfield" />
			
			<div class="notice info"><p>Êtes-vous sûr de vouloir suprimer le groupe <?php echo htmlentities($group['group_name']); ?> ?</p></div>
		
			<div class="t_center">
				<a href="<?php echo getURL('groups'); ?>" class="d_button">Non</a>
				<input type="submit" value="Oui" />
			</div>
		</form>
	</div>
</div>

<?php include(APPPATH . 'views/admin_foot.php'); ?>
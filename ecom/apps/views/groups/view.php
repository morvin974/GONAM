<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/admin_head.php');
?>

<div class="data_box">
	<div class="d_title"><p>Gestion des groupes</p></div>
	<div class="d_content">
		<p>Liste des groupes présent dans la base de donnée.</p>
		<hr />
		<?php if (getSessionFlash('groups') !== '') { ?>
		<div class="notice success"><p><?php echo getSessionFlash('groups'); ?></p></div>
		<?php } ?>
		<table class="d_table">
			<tr><th>ID</th><th>Groupe</th><th>Action(s)</th></tr>
			<?php foreach ($groups as $data) { ?>
			<tr>
				<td class="t_center"><?php echo $data['id_group']; ?></td>
				<td class="t_center"><?php echo htmlentities($data['group_name']); ?></td>
				<td class="t_center">
					<a href="<?php echo getURL('groups', 'edit', array('id' => $data['id_group'])); ?>" class="d_icon edit"></a>
					<a href="<?php echo getURL('groups', 'del', array('id' => $data['id_group'])); ?>" class="d_icon del"></a>
				</td>
			</tr>
			<?php } ?>
		</table>
		<hr />
		<div class="t_center">
			<a href="<?php echo getURL('groups', 'add'); ?>" class="d_button">Ajouter un groupe</a>
		</div>
	</div>
</div>

<?php include(APPPATH . 'views/admin_foot.php'); ?>
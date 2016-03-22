<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/admin_head.php');
?>

<div class="data_box">
	<div class="d_title"><p>Gestion des utilisateurs</p></div>
	<div class="d_content">
		<p>Liste des utilisateurs présents dans la base de donnée.</p>
		<hr />
		<?php if (getSessionFlash('groups') !== '') { ?>
		<div class="notice success"><p><?php echo getSessionFlash('users'); ?></p></div>
		<?php } ?>
		<table class="d_table">
			<tr><th>ID</th><th>E-Mail</th><th>Nom</th><th>Action(s)</th></tr>
			<?php foreach ($users as $data) { ?>
			<tr>
				<td class="t_center"><?php echo $data['id_user']; ?></td>
				<td class="t_center"><?php echo htmlentities($data['user_mail']); ?></td>
				<td class="t_center"><?php echo htmlentities($data['user_name']) . ' ' . htmlentities($data['user_firstname']); ?></td>
				<td class="t_center">
					<a href="<?php echo getURL('users', 'edit', array('id' => $data['id_user'])); ?>" class="d_icon edit"></a>
				</td>
			</tr>
			<?php } ?>
		</table>
		<?php if ($nbPage > 0) { ?>
		<div class="pagination">
			<?php for ($i = 1; $i > $nbPage; $i++) { ?>
			<a href="<?php echo getURL('users', 'view', array('page' => $i)); ?>"><?php echo $i; ?></a>
			<?php } ?>
		</div>
		<?php } ?>
		<hr />
		<div class="t_center">
			<a href="<?php echo getURL('users', 'add'); ?>" class="d_button">Ajouter un utilisateur</a>
		</div>
	</div>
</div>

<?php include(APPPATH . 'views/admin_foot.php'); ?>
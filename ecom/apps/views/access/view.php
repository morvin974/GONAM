<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/admin_head.php');
?>

<div class="data_box">
	<div class="d_title"><p>Gestion des accès</p></div>
	<div class="d_content">
		<table class="d_table">
			<tr><th>Page</th><th>Niveau requis</th><th>Action(s)</th></tr>
			<?php foreach ($data as $access) { ?>
			<tr>
				<td><?php echo htmlentities($access['page']); ?></td>
				<td class="t_center"><?php echo htmlentities($access['level']); ?></td>
				<td class="t_center">
					<a href="<?php echo getURL('access', 'del', array('page' => $access['page'])); ?>" class="d_icon del"></a>
				</td>
			</tr>
			<?php } ?>
		</table>
		<hr />
		<div class="t_center">
			<a href="<?php echo getURL('access', 'add'); ?>" class="d_button">Ajouter un accès</a>
		</div>
	</div>
</div>

<?php include(APPPATH . 'views/admin_foot.php'); ?>
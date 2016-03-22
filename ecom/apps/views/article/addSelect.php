<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/admin_head.php');
?>

<div class="data_box">
	<div class="d_title"><p>Ajouter un article</p></div>
	<div class="d_content">
		<p>Sélectionner la catégorie de l'article que vous voulez ajouter.</p>
		<hr />

		<table class="d_table">
			<tr><th>Nom de la catégorie</th><th>Action</th></tr>
			<?php foreach($categories as $cat) { ?>
			<tr>
				<td class="t_center"><?php echo htmlentities($cat['category_name']); ?></td>
				<td class="t_center"><a class="d_button" href="<?php echo getURL('article', 'addSelect', array('cat' => intval($cat['id_category']))); ?>">Choisir</a></td>
			</tr>
			<?php } ?>
		</table>
		<hr />
		<div class="t_center">
			<a href="<?php echo getURL('article', 'admin'); ?>" class="d_button">Retour</a>
		</div>
	</div>
</div>

<?php include(APPPATH . 'views/admin_foot.php'); ?>
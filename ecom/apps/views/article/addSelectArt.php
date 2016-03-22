<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/admin_head.php');
?>

<div class="data_box">
	<div class="d_title"><p>Ajouter un article</p></div>
	<div class="d_content">
		<p>Sélectionner l'article que vous voulez ajouter au magasin.</p>
		<hr />

		<table class="d_table">
			<tr><th>Référence</th><th>Nom de l'article</th><th>Action</th></tr>
			<?php foreach($articles as $art) { ?>
			<tr>
				<td class="t_center"><?php echo intval($art['id_article']); ?></td>
				<td class="t_center"><?php echo htmlentities($art['article_title']); ?></td>
				<td class="t_center"><a class="d_button" href="<?php echo getURL('article', 'add', array('art' => intval($art['id_article']))); ?>">Choisir</a></td>
			</tr>
			<?php } ?>
		</table>
		<hr />
		<div class="t_center">
			<a href="<?php echo getURL('article', 'addSelect'); ?>" class="d_button">Retour</a>
		</div>
	</div>
</div>

<?php include(APPPATH . 'views/admin_foot.php'); ?>
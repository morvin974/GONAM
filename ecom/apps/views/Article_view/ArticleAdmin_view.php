<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/admin_head.php');
?>

<div class="data_box">
	<div class="d_title"><p>Gestions des articles</p></div>
	<div class="d_content">
		
		<p>Liste des articles présents sur la base de données.</p>
		<hr />
		
		<table class="d_table">
			<tr><th>ID</th><th>Titre</th><th>Prix</th><th>Action(s)</th></tr>
			<?php foreach ($data as $value) { ?>
			<tr>
				<td class="t_center"><?php echo $value->id_article; ?></td>
				<td class="t_center"><?php echo $value->article_title; ?></td>
				<td class="t_center"><?php echo $value->article_price_dutyfree; ?></td>
				<td class="t_center">
					<a href="<?php echo getURL('article', 'afficherModifierArticle', array('idarticle' => $value->id_article)); ?>" class="d_icon edit"></a>
				</td>
			</tr>
			<?php } ?>
		</table>
		<br>
		<div class="t_center">
			<a href="<?php echo getURL('article', 'addSelect'); ?>" class="d_button">Ajouter un article </a><br>
		</div>
		
		
	</div>
</div>

<?php include(APPPATH . 'views/admin_foot.php'); ?>
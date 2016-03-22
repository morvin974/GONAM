<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include(APPPATH . 'views/admin_head.php');

?>
	
	<div class="data_box">
	
		<div class="d_title"><p>Info sur la commandes</p></div>
		
		<div class="d_content">
		
			<p><b>ID de la commande : </b><?php echo htmlentities($data[0]->id_order); ?>. </p>
			<p><b>Utilisateur : </b><?php echo htmlentities($data[0]->user_firstname); ?> <?php echo htmlentities($data[0]->user_name); ?></p>
			
			<p><b>Prix du panier (HT) : </b><?php echo $data[0]->order_delivery_price + $data[0]->order_price_HT; ?> €</p>

			<br/>
			
			<hr/>
			
			<table class="d_table">
				<tr><th>Article</th><th>Description</th><th>Prix Unitaire</th><th>Quantité</th></tr>
				<?php foreach ($data as $value) { ?>
				<tr>
					<td class="t_center"><a href="index.php?m=article&a=ficheArticle&idarticle=<?php echo $value->id_article ?>"><?php echo htmlentities($value->article_title); ?></a></td>
					<td class="t_center"><?php echo htmlentities($value->article_description); ?></td>
					<td class="t_center"><b><?php echo htmlentities($value->article_price_dutyfree); ?> €</b></td>
					<td class="t_center"><?php echo htmlentities($value->quantity); ?></td>
				</tr>
				<?php } ?>
			</table>
			
		</div>
		
	</div>
		
<?php include(APPPATH . 'views/admin_foot.php'); ?>

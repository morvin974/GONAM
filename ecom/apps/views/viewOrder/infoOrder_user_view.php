<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/head.php');
?>
	
	<div>
	
		<div class="title">Info sur la commandes du <?php echo $data[0]->order_date; ?></div>
		
		<div>

			<table>
				<tr><th>Article</th><th>Description</th><th>Prix</th><th>Quantité</th></tr>
				<?php foreach ($data as $value) { ?>
				<tr>
					<td class="txtcenter"><a href="index.php?m=article&a=ficheArticle&idarticle=<?php echo $value->id_article ?>"><?php echo htmlentities($value->article_title); ?></a></td>
					<td class="txtcenter"><?php echo htmlentities($value->article_description); ?></td>
					<td class="txtcenter"><b><?php echo htmlentities($value->article_price_dutyfree); ?> €</b></td>
					<td class="txtcenter"><?php echo htmlentities($value->quantity); ?></td>
				</tr>
				<?php } ?>
			</table>
			
			<div class="txtcenter"><p><b>Prix du panier (HT) : </b><?php echo $data[0]->order_delivery_price + $data[0]->order_price_HT; ?> €</p></div>
			
		</div>
		
	</div>
		
<?php include(APPPATH . 'views/foot.php'); ?>

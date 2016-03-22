<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/head.php');
?>


	<?php
		if (hasErrorForm()) {
			echo getErrorForm() ;
		} 
	?>

	<div class="title">Commande</div>
	
	<form action="<?php echo getURL("order", "validerPanier"); ?>" method="post" >
	
		<div class="col half">
			
			<h2>Adresse de livraison : </h2>
			
			<div>
			<label for="order_delivery_address">Adresse : </label>
			<input type="text" value="<?php echo getPostData('order_delivery_address') ?>" id ="order_delivery_address" placeholder="ex : 2 rue de la République" name="order_delivery_address" /><br />
			</div>
			
			<div>
			<label for="order_delivery_city">Ville : </label>
			<input type="text" value="<?php echo getPostData('order_delivery_city')?>" id ="order_delivery_city" placeholder="ex : Paris" name="order_delivery_city" /><br />
			</div>
			
			<div>
			<label for="order_delivery_postcode">Code postal : </label>
			<input type="text" value="<?php echo getPostData('order_delivery_postcode')?>" placeholder="ex : 75001" id ="order_delivery_postcode" name="order_delivery_postcode" /><br />
			</div>
			
		</div>
		
		<div class="col half">
			
			<h2>Adresse de facturation : </h2>
			
			<div>
			<label for="order_billing_address">Adresse : </label>
			<input type="text" value="<?php echo getPostData('order_billing_address')?>" id ="order_billing_address" placeholder="ex : 2 rue de la République" name="order_billing_address" /><br />
			</div>
			
			<div>
			<label for="order_billing_city">Ville : </label>
			<input type="text" value="<?php echo getPostData('order_billing_city')?>" placeholder="ex : Paris" id ="order_billing_city" name="order_billing_city" /><br />
			</div>
			
			<div>
			<label for="order_billing_postcode">Code postal : </label>
			<input type="text" value="<?php echo getPostData('order_billing_postcode')?>" placeholder="ex : 75001" id ="order_billing_postcode" name="order_billing_postcode" /><br /><br />
			</div>
			
		</div>
	
		
		<!--Entreprise : 	
		<div>
		<input type="text" name="article_brand" />
		</div>
		-->
		
		

		<div>

			<h2>Articles dans la commande : </h2>
			<table>
				<thead>
					<tr>
						<th>Aperçu</th>
						<th>Article</th>
						<th>Prix à l'Unité (HT)</th>
						<th>Quantité</th>
						<th>Total</th>
					  
					</tr>
				</thead>
				<tbody>

					<?php
					foreach ($data[0] as $value) {
					
					?>

						<tr>
						
							<td class="txtcenter" > <a href="?m=article&a=fichearticle&idarticle=<?php echo $value->id_article;?>"><img src="<?php echo $value->article_photo?>" alt="article" height="60" width="60"> </a></td>
							<td><a href="?m=article&a=fichearticle&idarticle=<?php echo $value->id_article;?>"><?php echo $value->article_title; ?></a><br /><small><?php echo $value->article_brand; ?></small></td>
	
							<td class="txtcenter"><b><?php echo $value->article_price_dutyfree; ?> €</b></td>
							<td class="txtcenter"><?php echo $value->quantity; ?></td>
							<td class="txtcenter"><b><?php echo $value->article_price_dutyfree * $value->quantity;?> €</b></td>
						  
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
			
		</div>
		
		<br/>
		<span class="txtcenter" ><h2>Date de livraison estimée : <?php echo date( "d-m-Y", time() + 7 * 24 * 60 * 60 ); ?></h2><br /></span>
		
		<div class="txtcenter" >
		<h2>Récapitulatif de la commande :</h2>
		Total du prix des articles (Hors Taxe) : <b><?php echo $data[1]->cart_price_HT; ?> €</b><br />
		Livreur : <b><?php echo $data[3][0]->delivery_name;?>. </b>
		Fais de livraison : <b><?php echo $data[3][0]->delivery_price;?> €</b><br />
		Total (HT+livraison) : <b><?php echo $data[1]->cart_price_HT + $data[3][0]->delivery_price;?> €</b><br />
		<b>Total (Avec la TVA) : <?php echo (1+$data[1]->tax_tva) * ($data[1]->cart_price_HT + $data[3][0]->delivery_price);?> €</b><br />
		<br/>
		<input type="submit" class="green" value="Valider Panier et procéder au paiement"/>
	  
		</div>
		</form>
	  
		
		
		<!--<br/><a href="index.php?m=order&a=validerPanier">Valider Panier et procéder au paiement</a>-->
		
<?php include(APPPATH . 'views/foot.php'); ?>

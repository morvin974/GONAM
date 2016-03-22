<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/head.php');
?>


	<div class="title">Panier actif</div>
	
    <table id="tab" class="tablesorter">
        <thead>
            <tr>
                <th>Aperçu</th>
                <th>Article</th>
                <th>Prix Unité (HT)</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($data[0] as $value) {
            ?>

                <tr>
                    <td class="txtcenter" > <a href="?m=article&a=fichearticle&idarticle=<?php echo $value->id_article;?>"><img src="<?php echo $value->article_photo?>" alt="article" height="60" width="60"> </a></td>
                    
					
					<td><a href="?m=article&a=fichearticle&idarticle=<?php echo $value->id_article;?>"><?php echo $value->article_title; ?></a><br /><small><?php echo $value->article_brand; ?></small></td>
					
                    <td class="txtcenter" ><b><?php echo $value->article_price_dutyfree; ?> €</b></td>
                    <td class="txtcenter" ><b><?php echo $value->article_price_dutyfree * $value->quantity;?> €</b></td>
                    <td class="txtcenter" >
						<form method="POST" action="?m=cart&a=modifierArticleInCart&idarticle=<?php echo $value->id_article; ?>">
							<input type="text" size="3" value="<?php echo $value->quantity;?>" name="quantite" />
							<input type="submit" class="green" value="modifier" />
						</form>
						<br />
						<a href="index.php?m=cart&a=supprimerArticleInCart&idarticle=<?php echo $value->id_article;?>"> <button> Supprimer Article</button></a>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>


        <h3>Montant (hors livraison, ni tva) : <b><?php echo $data[1]->cart_price_HT; ?> €</b></h3>
        <hr>
		
        <h2>Informations livraison</h2>
        <p>Livreur : <?php echo $data[3][0]->delivery_name;?></p>
        <p>Frais de livraison : <b><?php echo $data[3][0]->delivery_price;?> €</b></p>
		
		<form action="<?php echo getURL("cart", "setDelivery"); ?>" method="POST">
		<select id="id_delivery" name="id_delivery">
		<?php
		foreach ($data[2] as $value) {
		?>	
			<option value="<?php echo $value->id_delivery ?>"> <?php echo $value->delivery_name ?></option>
		<?php
		}
		?>
		</select><button class="green">Changer de livreur</button>
		</form>
		
        <h3>Montant avec livraison (hors tva) : <b><?php echo $data[1]->cart_price_HT + $data[3][0]->delivery_price;?> €</b></h3>
        <hr>

        <h1>Montant total (tva et livraison) : <b><?php echo (1+$data[1]->tax_tva) * ($data[1]->cart_price_HT + $data[3][0]->delivery_price);?> €</b></h2>

		<!-- <a href="index.php?m=validation"> Supprimer Article </a> -->

		<a href="index.php?m=order"><button>Validation du panier</button></a>
		
		
		
<?php include(APPPATH . 'views/foot.php'); ?>

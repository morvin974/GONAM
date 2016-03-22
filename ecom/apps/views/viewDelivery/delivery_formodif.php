<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include(APPPATH . 'views/admin_head.php');

?>


	<div class="data_box">
	
		<div class="d_title"><p>Modification du moyen de livraison : <?php echo $data[0]->delivery_name ?></p></div>
		
		<div class="d_content">
		
			<hr/>
		
			<?php if(hasErrorForm()) echo getErrorForm(); ?>
			
			<form method="POST" action="?m=delivery&a=modifierDelivery&id_delivery=<?php echo $data[0]->id_delivery; ?>">
			
			<?php
				echo "<b>ID</b> : ".$data[0]->id_delivery."<br/>";
				echo "<b>Nom</b> : <input type=\"text\" value=\"".$data[0]->delivery_name."\" required size=\"35\" name=\"name\"/><br/>";
				echo "<b>Prix</b> : <input type=\"text\" value=\"".$data[0]->delivery_price."\" required size=\"35\" name=\"price\"/>€<br/>";
			
			?>
			
			<button type="submit" id="okButton">Modifier</button>		
			</form>
			
		</div>
		
	</div>




	
<?php include(APPPATH . 'views/admin_foot.php'); ?>


















































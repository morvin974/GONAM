<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include(APPPATH . 'views/admin_head.php');

?>
	
	<div class="data_box">
	
		<div class="d_title"><p>Ajout d'un moyen de livraison</p></div>
		
		<div class="d_content">
		
		
			<?php if(hasErrorForm()) echo getErrorForm(); ?>
			
	
			<?php	 	 	 	 	 	 	 	 
				echo "<form method=\"POST\" action=\"?m=delivery&a=ajouteDelivery\">";
										 
				echo "<label>Nom</label> <input type=\"text\" value=\"".getPostData('name')."\" required size=\"35\" name=\"name\"/><br/>";
				echo "<label>Prix</label> <input type=\"text\" value=\"".getPostData('price')."\" required size=\"35\" name=\"price\"/><br/>";
				
				echo "<div class=\"form_action\"><button type=\"submit\" id=\"okButton\">Ajouter</button></div>";
				
				echo "</form>";

			?>
			
		</div>
		
	</div>
	
	
	

<?php include(APPPATH . 'views/admin_foot.php'); ?>














<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include(APPPATH . 'views/admin_head.php');

?>

	<div class="data_box">
	
		<div class="d_title"><p>Liste des moyens de livraison</p></div>
		
		<div class="d_content">
		
			<table class="d_table">
				<tr><th>ID</th><th>Mode de livraison</th><th>Prix</th><th>Action</th></tr>
				<?php foreach ($data as $value) { ?>
				<tr>
					<td class="t_center"><?php echo htmlentities($value->id_delivery); ?></td>
					<td class="t_center"><?php echo htmlentities($value->delivery_name); ?></td>
					<td class="t_center"><?php echo htmlentities($value->delivery_price); ?></td>
					<td class="t_center"><a href="index.php?m=delivery&a=formModifierDelivery&id=<?php echo htmlentities($value->id_delivery); ?>" class="d_icon go"></a><a href="index.php?m=delivery&a=supprimerDelivery&id=<?php echo htmlentities($value->id_delivery); ?>" class="d_icon del"></a></td>
				</tr>
				<?php } ?>
			</table>
			<hr />
			<div class="t_center">
				<a href="<?php echo getURL('delivery', 'formulaireAjoutDelivery'); ?>" class="d_button">Ajouter un moyen de livraison </a><br>
			</div>
			
		</div>
		
	</div>
	
<?php include(APPPATH . 'views/admin_foot.php'); ?>














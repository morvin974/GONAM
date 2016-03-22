<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/head.php');
?>

	<div>
	
		<div class="title">Historique de vos commandes</div>
		
		<div>
		
			<p>Voici un historique de vos commandes</p>
		
			<table>
				<tr><th>Statut de la commande</th><th>Date de la commande</th><th>action</th></tr>
				<?php foreach ($data as $value) { ?>
				<tr>
					<td class="txtcenter"><?php if($value->order_status==1) echo "Commande reçu"; else if($value->order_status==2) echo "Commande envoyée"; else echo "Commande en préparation"; ?></td>
					<td class="txtcenter"><?php echo htmlentities($value->order_date); ?></td>
					<td class="txtcenter"><a href="index.php?m=order&a=affichageInfoOrderUser&id_order=<?php echo htmlentities($value->id_order); ?>&date=<?php echo htmlentities($value->order_date); ?>">Voir infos</a></td>
				</tr>
				<?php } ?>
			</table>
			
		</div>
		
	</div>
	

<?php include(APPPATH . 'views/foot.php'); ?>
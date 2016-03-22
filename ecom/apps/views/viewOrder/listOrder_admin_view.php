<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include(APPPATH . 'views/admin_head.php');

?>
	<div class="data_box">
	
		<div class="d_title"><p>Historique des commandes</p></div>
		
		<div class="d_content">
		
			<hr/>
		
			<table class="d_table">
				<tr><th>id_order</th><th>order_date</th><th>user_firstname</th><th>user_name</th><th>id_cart</th><th>action</th></tr>
				<?php foreach ($data as $value) { ?>
				<tr>
					<td class="t_center"><?php echo htmlentities($value->id_order); ?></td>
					<td class="t_center"><?php echo htmlentities($value->order_date); ?></td>
					<td class="t_center"><?php echo htmlentities($value->user_firstname); ?></td>
					<td class="t_center"><?php echo htmlentities($value->user_name); ?></td>
					<td class="t_center"><?php echo htmlentities($value->id_cart); ?></td>
					<td class="t_center"><a href="index.php?m=order&a=affichageInfoOrderAdmin&id_order=<?php echo htmlentities($value->id_order); ?>" class="d_icon go"></a></td>
				</tr>
				<?php } ?>
			</table>
			
		</div>
		
	</div>
	

<?php include(APPPATH . 'views/admin_foot.php'); ?>
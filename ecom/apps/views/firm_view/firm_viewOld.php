<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/admin_head.php');
?>

<div class="data_box">
	<div class="d_title"><p>Gestion des Entreprises</p></div>	
	<div class="d_content">
		<h2> page de gestion des entreprise </h2>
		<p> Page qui regroupe les différentes action pouvant être réalisé sur les entreprises , que ce soit pour ajouter supprimmer ou modifier une entreprise ciblée.
		</p>
		<hr />
		<table class="d_table">
			<tr><th>Nom</th><th>Ville</th><th>Email</th><th>Numéro</th><th>Action</th></tr>
			<?php foreach ($data as $value) { ?>
			<tr>
				<td  class="t_center"><?php echo htmlentities($value->firm_name);?></td>	
				<td  class="t_center"><?php echo htmlentities($value->firm_city);?></td>
				<td  class="t_center"><?php echo htmlentities($value->firm_mail);?></td>
				<td  class="t_center"><?php echo htmlentities($value->firm_phone);?></td>	
				<td  class="t_center">
				<a href="index.php?m=firm&a=modifierFirm&id_firm=<?php echo htmlentities($value->id_firm);?>" class="d_icon edit"></a>
				<a href="index.php?m=firm&a=supprimerFirm&id_firm=<?php echo htmlentities($value->id_firm);?>" class="d_icon del"></a></td>
			</tr>
			<?php } ?>			
		</table>
		<hr />
		<div class="form-action t_right"><a href="index.php?m=Firm&a=afficherCreerFirm" class="d_button">Ajouter</a></div>
		<div class="pagination">
			<span>« First</span><a href="#">1</a><a href="#" class="active">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a><a href="#">Last »</a>
		</div>
	</div>
</div>

<?php include(APPPATH . 'views/admin_foot.php'); ?>

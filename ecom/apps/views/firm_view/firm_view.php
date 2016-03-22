<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/admin_head.php');
?>

<div class="data_box">
	<div class="d_title"><p>Gestion des Entreprises</p></div>	
	<div class="d_content">
		<p>Cette page qui regroupe les différentes informations sur les entreprises enregistrées dans la base de données.
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
					<a href="<?php echo getURL("firm", "modifierFirm", array('id_firm' => $value->id_firm)); ?>" class="d_icon edit"></a>
					<a href="<?php echo getURL("firm", "supprimerFirm", array('id_firm' => $value->id_firm)); ?>" class="d_icon del"></a>
				</td>
			</tr>
			<?php } ?>	
		</table>
		<hr />
		<div class="t_center">
			<a href="<?php echo getURL("firm", "afficherCreerFirm"); ?>" class="d_button">Ajouter une entreprise</a>
		</div>
	</div>
</div>

<?php include(APPPATH . 'views/admin_foot.php'); ?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/admin_head.php');
?>

<div class="data_box">
	<div class="d_title"><p>Gestions des categories d'articles</p></div>
	<div class="d_content">
		
		
		
		<p><?php if(isset($data[0]) && $data[0]->id_category_mother == null) echo "Liste des Categories racines ";  else 
				echo "Liste des sous-categories de :".$mere->category_name;?></p>
		<hr />
		
		<table class="d_table">
			<tr><th>ID</th><th>Titre</th><th>Fils</th><th>Action(s)</th> </tr>
			<?php foreach ($data as $value) { ?>
			<tr>
				<td class="t_center"><?php echo $value->id_category; ?></td>
				<td class="t_center"><?php echo $value->category_name; ?></td>
				<td class="t_center">
					<a href="<?php echo getURL('categorie', 'admin', array('idcategory' => $value->id_category)); ?>"> fils </a>
				</td>
				<td class="t_center">
					<a href="<?php echo getURL('categorie', 'afficherModificationCategorie', array('id' => $value->id_category)); ?>" class="d_icon edit"></a>
				</td>
				
			</tr>
			<?php } ?>
		</table>
		<br>
		<div class="t_center">
			<?php if(isset($data[0]) && $data[0]->id_category_mother == null){ ?>
			<a href="<?php echo getURL('categorie', 'afficherCreerCategorie', array('idcategorie' => '-1' )); ?>" class="d_button">Ajouter une Categorie Racine </a><br>
			<?php } else { ?>
			<a href="<?php echo getURL('categorie', 'afficherCreerCategorie', array('idcategorie' => $mere->id_category)); ?>" class="d_button">Ajouter une Categorie </a><br>
			<?php } ?>
		</div>
		
		
	</div>
</div>

<?php include(APPPATH . 'views/admin_foot.php'); ?>
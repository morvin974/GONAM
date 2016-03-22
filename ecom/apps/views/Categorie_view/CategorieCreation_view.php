<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/admin_head.php');

?>

	<div class="data_box">
		<div class="d_title"><p>Ajouter une Categorie</p></div>
		<div class="d_content">
		
			<?php if (hasErrorForm()) { ?>
			<div class="notice error"><?php echo getErrorForm(); ?></div>
			<?php } ?>
			
			
			<form action="index.php?m=Categorie&a=creerCategorie" method="post">
				<label for="cat_name">Nom de la categorie</label>
				<input type="text" name="cat_name" size="50" value="<?php echo getPostData('cat_name');?>"/>
				<br>
			
				<label for="cat_desc">Description</label> 	
				<input type="text" name="cat_desc" value="<?php echo getPostData('cat_desc');?>" />
				<br>
		
				<label for="cat_parent">Categorie mère</label>  
				<select name="cat_parent">
				<option value="-1" selected >Categorie racine</option>
				<?php foreach ($data as $value) { ?>
					<?php if(isset($idcategorie) && $value->id_category == $idcategorie) { ?>
						<option selected  value="<?php echo $value->id_category ?>" ><?php echo htmlentities($value->category_name);?></option>
					<?php  } else {?>
					<option value="<?php echo $value->id_category ?>"><?php echo htmlentities($value->category_name);?></option>
					<?php } ?>
				<?php } ?>
				</select>
			
			
				<div class="form_action">
					<a href="<?php echo getURL('users'); ?>" class="d_button">Retour</a>
					<input type="submit" value="Ajouter" />
				</div>
			</form>
		</div>
	</div>


		
		
		
	





<?php include(APPPATH . 'views/admin_foot.php'); ?>


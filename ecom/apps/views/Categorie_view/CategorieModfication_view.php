<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/admin_head.php');
?>

	<div class="data_box">
		<div class="d_title"><p>Modifier une categorie <?php echo $data->category_name; ?></p></div>
		<div class="d_content">
		
			<?php if (hasErrorForm()) { ?>
			<div class="notice error"><?php echo getErrorForm(); ?></div>
			<?php } ?>


			
			
			<form method="post" action="index.php?m=Categorie&a=modifierCategorie&id=<?php echo $data->id_category;?>">
				<label for="cat_name">Nom de la categorie </label>		
				<input type="text" name="cat_name" value="<?php echo htmlentities($data->category_name) ;?>" />
				
				<br>
				<label for="cat_desc">Descritpion : </label>
				<textarea rows="10" cols="100" name="cat_desc"><?php echo htmlentities($data->category_description) ;?></textarea>
				
				
				<label for="cat_parent">Catégorie parente : </label>
				<SELECT name="cat_parent">
				<?php foreach ($cat_parent as $value) { ?>
						<option value="<?php echo $value->id_category;?>" ><?php echo htmlentities($value->category_name);?></option>
				<?php } ?>
				</SELECT>
				<a href="<?php echo getURL('users'); ?>" class="d_button">Retour</a>
				<input type="submit"  class="d_button" value="Valider"  />
				<br>
			</form>	
	
	</div>
</div>

<?php include(APPPATH . 'views/admin_foot.php'); ?>
			








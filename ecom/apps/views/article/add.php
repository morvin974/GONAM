<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/admin_head.php');
?>

<div class="data_box">
	<div class="d_title"><p>Ajouter un article</p></div>
	<div class="d_content">
		<?php if (hasErrorForm()){?>
			<div class="notice error"> <?php echo getErrorForm(); ?> </div>
		<?php } ?>

		<form action="<?php echo getURL('article', 'add', array('art' => $_GET['art'])); ?>" method="post">
			<label for="article_title">Titre</label>
				<input type="text" name="article_title" size="50" value="<?php echo htmlentities($artData['article_title']);?>"/>
				<br />
			
			<label for="article_brand">Marque</label> 	
				<input type="text" name="article_brand" value="<?php echo htmlentities($artData['article_brand']);?>" />
				<br />
				
			<label for="article_price_dutyfree">Prix</label> 	
				<input type="text" size="10" name="article_price_dutyfree" value="<?php echo htmlentities($artData['article_price_dutyfree']);?>"/>
				<br />
				
			<label for="article_description">Description</label> 	
				<textarea rows="6" cols="64" name="article_description"><?php echo htmlentities($artData['article_description']); ?></textarea>
				<br />
				
			<label for="article_photo">Photo</label> 
				<input type="text" size="60" name="article_photo" value="<?php echo htmlentities($artData['article_photo']);?>" />
				<br />
				
			<label for="article_weight">Poids</label> 
				<input type="text" size="10" name="article_weight" value="<?php echo htmlentities($artData['article_weight']);?>"/>
				<br />	
					
			<label for="id_category">Catégorie</label>  
				<select name="id_category">
				<?php
				foreach ($catData as $value) { 
					echo "<option value=\"".$value->id_category."\">".$value->category_name."</option>";
				}
				?>
				</select>
			
				<div class="form_action">
					<a href="<?php echo getURL('article', 'addSelect'); ?>" class="d_button">Retour</a>
					<input type="submit" value="Ajouter l'article" />
				</div>
			</form>
	</div>
</div>

<?php include(APPPATH . 'views/admin_foot.php'); ?>
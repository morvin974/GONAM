<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/admin_head.php');
?>
		

	<div class="data_box">
		<div class="d_title"><p>Ajouter un Article</p></div>
		<div class="d_content">
			<?php if (hasErrorForm()) { ?>
			<div class="notice error"><?php echo getErrorForm(); ?></div>
			<?php } ?>
			
			
			<form action="index.php?m=Article&a=CreerArticle" method="post">
				<label for="article_title">Titre</label>
				<input type="text" name="article_title" size="50" value="<?php echo getPostData('article_title');?>"/>
				<br>
			
				<label for="article_brand">Marque</label> 	
				<input type="text" name="article_brand" value="<?php echo getPostData('article_brand');?>" />
				<br>
				
				<label for="article_price_dutyfree">Prix</label> 	
				<input type="text" name="article_price_dutyfree" value="<?php echo getPostData('article_price_dutyfree');?>"/>
				<br>
				
				<label for="article_description">Description</label> 	
				<textarea rows="10" cols="100" name="article_description" value="<?php echo getPostData('article_description');?>"></textarea>
				<br>
				
				<label for="article_photo">Photo</label> 
				<input type="text" name="article_photo" value="<?php echo getPostData('article_photo');?>" />
				<br>
				
				<label for="article_stock">Stock</label> 
				<input type="text" name="article_stock" value="<?php echo getPostData('article_stock');?>" />
				<br>
				
				<label for="article_weight">Poids</label> 
				<input type="text" name="article_weight" value="<?php echo getPostData('article_weight');?>"/>
				<br>	
					
				<label for="id_category">Description</label>  
				<select name="id_category">
				
				<?php
				
				foreach ($data as $value) { 
					
					echo "<option value=\"".$value->id_category."\">".$value->category_name."</option>";
						
				}
				?>
				</select>
			
			
				<div class="form_action">
					<a href="<?php echo getURL('users'); ?>" class="d_button">Retour</a>
					<input type="submit" value="Ajouter" />
				</div>
			</form>
		</div>
	</div>

	<?php include(APPPATH . 'views/admin_foot.php'); ?>





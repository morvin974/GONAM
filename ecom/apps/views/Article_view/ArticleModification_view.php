<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/admin_head.php');
?>
	<?php 
		$list = $data;
	?>
	
	<div class="data_box">
		<div class="d_title"><p>Modifier <?php if (isset($data))echo $data[0]->article_title; ?><?php echo getPostData('article_title');?></p></div>
		<div class="d_content">
			<?php if (hasErrorForm()) { ?>
			<div class="notice error"><?php echo getErrorForm(); ?></div>
			<?php } ?>
			
			<form action="index.php?m=Article&a=modifierArticle&idarticle=<?php if (isset($data))echo $data[0]->id_article; else echo getPostData('id_article');?>" method="post">	
				<input type="hidden" name="id_article" value="<?php if (isset($data))echo $data[0]->id_article; else echo getPostData('id_article');?>"/>
				<br />
			
				<label for="article_title">Titre</label>
				<input type="text" name="article_title" size="50" value="<?php if (isset($data))echo $data[0]->article_title; else echo getPostData('article_title');?>"/>
				<br />
			
				<label for="article_brand">Marque</label> 	
				<input type="text" name="article_brand" value="<?php if (isset($data))echo $data[0]->article_brand; else echo getPostData('article_brand');?>" />
				<br />
				
				<label for="article_price_dutyfree">Prix</label> 	
				<input type="text" size="10" name="article_price_dutyfree" value="<?php if (isset($data))echo $data[0]->article_price_dutyfree; else echo getPostData('article_price_dutyfree');?>"/>
				<br />
				
				<label for="article_description">Description</label> 	
				<textarea rows="6" cols="64" name="article_description" ><?php if (isset($data))echo $data[0]->article_description; else echo getPostData('article_description');?></textarea>
				<br />
				
				<label for="article_photo">Photo</label> 
				<input type="text" size="60" name="article_photo" value="<?php if (isset($data))echo $data[0]->article_photo; else echo getPostData('article_photo');?>" />
				<br />
				
				<label for="article_sold">Vendus</label> 
				<input type="text" name="article_sold" value="<?php if (isset($data))echo $data[0]->article_sold; else echo getPostData('article_sold');?>" />
				<br />
				
				<label for="article_weight">Poids</label> 
				<input type="text" size="10" name="article_weight" value="<?php if (isset($data))echo $data[0]->article_weight; else echo getPostData('article_weight');?>"/>
				<br />	
					
				<label for="id_category">Catégorie</label>  
				<select name="id_category">
				<?php
				foreach ($list[1] as $value) { 
					if($value->id_category == $list[0]->id_category){
						echo "<option selected value=\"".$value->id_category."\">".$value->category_name."</option>";	
					}else {
						echo "<option value=\"".$value->id_category."\">".$value->category_name."</option>";	
					}
				}
				?>
				</select>
			
				<div class="form_action">
					<a href="<?php echo getURL('article','admin'); ?>" class="d_button">Retour</a>
					<input type="submit" value="Modifier" />
				</div>
			</form>
		</div>
	</div>

<div class="data_box">
	<div class="d_title"><p>Gestion du stock</p></div>
	<div class="d_content">
		<form action="<?php echo getURL('article', 'addStock', array('id' => $data[0]->id_article)); ?>" method="post">
			<label for="article_stock">Stock dans le magasin</label> 
				<input type="text" name="article_stock" value="<?php echo $data[0]->article_stock;?>" />
				 (disponible entrepôt : <?php echo htmlentities($stock); ?>)
				<br />

			<div class="t_center">
				<input type="submit" value="Modifier le stock" />
			</div>
		</form>
	</div>
</div>

<?php include(APPPATH . 'views/admin_foot.php'); ?>





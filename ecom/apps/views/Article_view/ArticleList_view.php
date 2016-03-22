<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/head.php');
?>
	<?php /*?>
	<div class="title">Cartes mères</div>
	<form action="#" method="get">
		<div class="row">
			<div class="col half">
				<div>
					<label for="byname">Nom de l'article</label>
					<input type="text" name="name" id="byname" size="24" maxlength="124" placeholder="Tous" />
				</div>
				<div>
					<label for="bycat">Note &gt; ou = à</label>
					<select name="cat" id="bycat">
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
				</div>
			</div>
			<div class="col half">
				<div>
					<label for="bycat">Catégorie</label>
					<select name="subcat" id="bycat">
						<option value="0">Cartes mères</option>
						<option value="1">&vdash; Socket AM2</option>
						<option value="2">&vdash; Socket AM3</option>
						<option value="3">&vdash; Socket 1150</option>
						<option value="4">&vdash; Socket 1155</option>
					</select>
				</div>
				<div>
					<input type="hidden" name="cat" value="0" />
					<input type="submit" value="Filtrer les articles" class="green" />
				</div>
			</div>
		</div>
	</form>
	<hr />
	
	<form action="#order" method="get">
		<div>
			<label for="byorder">Trier les articles par</label>
			<select name="order" id="byorder">
				<option value="name">Nom</option>
				<option value="cat">Catégorie</option>
				<option value="price">Prix</option>
				<option value="mark">Note</option>
			</select>
		</div>
	</form>
	<?php */?>	

	
	<?php 	if($categorie==true){?>
				<div class="title">Catégorie &raquo; <?php echo $data[0]->category_name; ?></div>
			<?php } ?>
	
	<table>
		<tr><th>Aperçu</th><th>Article</th><th>Note</th><th>Prix (TTC)</th><th>Dispo.</th><th style="width:15%;"></th></tr>
		<?php foreach ($data as $value) {
			?>
			<tr> 
	   
				<td class="txtcenter"><div class="art-view v-medium"><a href="#"><img src="<?php echo $value->article_photo;?>" title="Card" /></a></div></td>
			<td><a href="?m=article&a=fichearticle&idarticle=<?php echo $value->id_article;?>"><?php echo $value->article_title; ?></a><br /><small><?php echo $value->article_brand; ?></small></td>
			<?php	if(isset($value->moyenne)){?>
						<td class="txtcenter"><div class="mark-wrap"><div class="mark" style="width:<?php echo (($value->moyenne)*2)*10; ?>%"></div></div></td>
			<?php 	} 
					else { ?>
						<td class="txtcenter"></td>
					<?php } ?>
					
			<td class="txtcenter"><b><?php echo $value->article_price_dutyfree * 1.20; ?></td></b>
			<td class="txtcenter"><?php if($value->article_stock>=1) echo "En stock"; else echo "non dispo.";?></td>

			<td class="txtcenter">
			<?php if($value->article_stock>=1) {?>
			<form method="POST" action="?m=cart&a=ajoutArticleInCart&idarticle=<?php echo $value->id_article;?>" >
					        <input type="hidden" name="quantity" value="1" />
                            <input type="submit" class="button fill ecom-ic cartadd" value="Ajouter" />
                            </form>
                   	 </td>
			</tr> 
			<?php } ?>
			
			
			
<?php }?>
		
		
	</table>

<?php include(APPPATH . 'views/foot.php'); ?>
	





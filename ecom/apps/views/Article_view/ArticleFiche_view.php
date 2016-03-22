<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 include(APPPATH . 'views/head.php');

 ?>


	
	<div class="title"><?php echo $data[0]->article_title;?></div>
				<div class="row-spaced">
					<div class="col tiny">
						<div class="art-view v-large txtcenter"><img src="<?php echo $data[0]->article_photo?>" title="Card" /></div>
					</div>
					<div class="col large art">
						<div class="wrap"><b><?php echo $data[0]->article_title;?></b><br /><small><?php echo $data[0]->article_brand;?></small></div>
						<div class="wrap">EUR <?php echo $data[0]->article_price_dutyfree * 1.20;?>(<small><?php echo $data[0]->article_price_dutyfree ;?><sup>HT</sup>)</small></div>
						<div class="wrap"><?php if($data[0]->article_stock>=1) echo "Disponible"; else echo "non disponible";?></div>
						
						<?php	if(isset($data[1])){
								?> 	<div class="mark-wrap wrap"><div class="mark" style="width:<?php echo (($data[2])*2)*10; ?>%"></div></div>
								<?php } ?>
						
					</div>
				</div>
				<div class="txtcenter">
					<?php if($data[0]->article_stock>=1){ ?>
					<form method="POST" action="?m=cart&a=ajoutArticleInCart&idarticle=<?php echo $data[0]->id_article;?>" >
					Quantitée
					<input type="text" name="quantity" value="1" min="1" max="64" />
					<div>
						<input type="submit" class="button green ecom-ic cartadd" value="Ajouter au panier" />
					</div>
					<?php }?>
				</form>
				</div>
				
				<div class="title">Description</div>
				<p><?php echo $data[0]->article_description;?></p>
				
				<div class="title">Commentaire(s)</div>
				<?php
				if(isset($data[1])) {
					$i=1;
					foreach ($data[1] as $value) {
						?>
						<div class="comment">
							<div class="row">
								<div class="col huge">#<?php echo $i;?><b> <?php echo $value->user_name; ?> (<?php echo $value->notice_date; ?>)</b></div>
									<div class="col tiny txtright">
										<div class="mark-wrap"><div class="mark" style="width:<?php echo (($value->notice_mark)*2)*10; ?>%"></div></div>
									</div>
								</div>
							<div class="txtjustify"><p><?php echo $value->notice_description; ?></p></div>
						</div>
					<?php
					$i++;
					}
				}
				else {
					?>Aucun acheteur à publier un commentaire pour le moment.</p><?php
				}
				
				
				?>
				
				
				
				<div class="title">Poster un commentaire</div>
				<!--<div class="notice info"><p>Pour poster un commentaire vous devez être connecté.</p></div>-->
				<form action="?m=article&a=ajouterComment&idarticle=<?php echo $data[0]->id_article;?>" method="post">
					<div>
						<label for="comment-mark">Note</label>
						<select name="mark" id="comment-mark">
							<option>0</option>
							<option>1</option>
							<option>2</option>
							<option selected>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					</div>
					<div>
						<label for="description">Commentaire</label>
						<textarea rows="5" cols="60" name="description" id="description"></textarea>
					</div>
					<div class="form-action txtcenter">
						<input type="submit" value="Poster le commentaire" class="fill" />
					</div>
				</form>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<?php include(APPPATH . 'views/foot.php'); ?>
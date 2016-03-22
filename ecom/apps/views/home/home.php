<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/head.php');
?>

				<div class="title">Accueil</div>
				<div class="notice info"><p>Version DEMO.</p></div>
				
				<div class="title">Les nouveautés</div>
				<ul class="list-art art-view v-large">
				<?php 
				foreach ($data[0] as $value){?>
				
					<li><a href="?m=article&a=fichearticle&idarticle=<?php echo $value->id_article;?>">
						<div><img src="<?php echo $value->article_photo;?>" title="<?php echo $value->article_title;?>" /></div>
						<div class="art-go"><div class="art-text"><?php echo $value->article_title;?></div></div>
					</a><div class="price">EUR <?php echo ($value->article_price_dutyfree)*1.20;?></div></li>
					
				<?php }?>
				</ul>
				
				
				<div class="title">Les plus vendus</div>
				<ul class="list-art art-view v-large">
				<?php 
				foreach ($data[1] as $value){?>
				
					<li><a href="?m=article&a=fichearticle&idarticle=<?php echo $value->id_article;?>">
						<div><img src="<?php echo $value->article_photo;?>" title="<?php echo $value->article_title;?>" /></div>
						<div class="art-go"><div class="art-text"><?php echo $value->article_title;?></div></div>
					</a><div class="price">EUR <?php echo ($value->article_price_dutyfree)*1.20;?></div></li>
					
				<?php }?>
				</ul>
				
				<div class="title">Les mieux notés</div>
				<ul class="list-art art-view v-large">
					<?php foreach ($data[2] as $value){?>
				
					<li><a href="?m=article&a=fichearticle&idarticle=<?php echo $value->id_article;?>">
						<div><img src="<?php echo $value->article_photo;?>" title="<?php echo $value->article_title;?>" /></div>
						<div class="art-go"><div class="art-text"><?php echo $value->article_title;?></div></div>
					</a><div class="price">EUR <?php echo ($value->article_price_dutyfree)*1.20;?></div></li>
					
				<?php }?>
				</ul>

<?php include(APPPATH . 'views/foot.php'); ?>
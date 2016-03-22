<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
				<div class="title">Navigation</div>
				<ul class="nav">
					<li><a href="<?php echo getURL('home'); ?>">Accueil</a></li>
					<li><a href="<?php echo getURL('account', 'home'); ?>">Mon compte</a></li>
				</ul>
				<div class="title">Catégories</div>
				<ul class="nav">
					<?php $categoriesNav = getRootCategories();
					foreach ($categoriesNav as $category) { ?>
						<li><a href="<?php echo getURL('article', 'afficherListeArticle', array('idcategorie' => $category->id_category)); ?>"><?php echo htmlentities($category->category_name); ?></a></li>
					<?php } ?>
				</ul>
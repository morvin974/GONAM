<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		<div id="nav_wrap">
			<div class="nav_box">
				<div class="nav_title"><p>Général</p></div>
				<ul class="nav_menu">
					<li><a href="<?php echo getURL('admin'); ?>"><span class="nav_icon home"></span>Accueil</a></li>
					<li><a href="<?php echo getURL('firm'); ?>"><span class="nav_icon setting"></span>Entreprises</a></li>
				</ul>
			</div>
			<div class="nav_box">
				<div class="nav_title"><p>Utilisateurs</p></div>
				<ul class="nav_menu">
					<li><a href="<?php echo getURL('users'); ?>"><span class="nav_icon user"></span>Utilisateurs</a></li>
					<li><a href="<?php echo getURL('groups'); ?>"><span class="nav_icon group"></span>Groupes</a></li>
					<li><a href="<?php echo getURL('access'); ?>"><span class="nav_icon access"></span>Accès</a></li>
				</ul>
			</div>
			<div class="nav_box">
				<div class="nav_title"><p>Articles</p></div>
				<ul class="nav_menu">
					<li><a href="<?php echo getURL('article', 'admin'); ?>"><span class="nav_icon article"></span>Articles</a></li>
					<li><a href="<?php echo getURL('categorie', 'admin'); ?>"><span class="nav_icon category"></span>Catégories</a></li>
				</ul>
			</div>
			<div class="nav_box">
				<div class="nav_title"><p>Commandes</p></div>
				<ul class="nav_menu">
					<li><a href="<?php echo getURL('delivery'); ?>"><span class="nav_icon plane"></span>Mode de livraison</a></li>
					<li><a href="<?php echo getURL('order', 'listOrder'); ?>"><span class="nav_icon card"></span>Commandes</a></li>
				</ul>
			</div>
		</div>
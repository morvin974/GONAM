<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
			</div>
		</div>
	</section>
	
	<footer>
		<div class="row-spaced">
			<div id="sitemap" class="col huge">
				<div class="title">Plan du site</div>
				<ul>
					<li><a href="<?php echo getURL('home'); ?>">&raquo; Accueil</a></li>
					<li><a href="<?php echo getURL('contact'); ?>">&raquo; Contact</a></li>
					<li><a href="#">&raquo; CGV</a></li>
					<li><a href="<?php echo getURL('account', 'login'); ?>">&raquo; Connexion</a></li>
					<li><a href="<?php echo getURL('account', 'register'); ?>">&raquo; Inscription</a></li>
				</ul>
			</div>
			<div class="col tiny">
				<div class="title">Paiement(s) disponible(s)</div>
				<div id="logo-pay">
					<img src="./public/imgs/logo-jabb.png" title="Jabb" />
					<img src="./public/imgs/logo-yolo.png" title="Payolo" />
				</div>
			</div>
		</div>
		<div id="copyright">
			<p>&copy;2015 GONAM, ventes de produit électronique. Tout droits réservés.</p>
		</div>
	</footer>
</body>
</html>

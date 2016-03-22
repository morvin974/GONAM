<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/head.php');
?>
				<div class="title">Generiq system card</div>
				<div class="row-spaced">
					<div class="col tiny">
						<div class="art-view v-large txtcenter"><img src="./public/imgs/thumb.png" title="Card" /></div>
					</div>
					<div class="col large art">
						<div class="wrap"><b>Generiq system card</b><br /><small>Asus</small></div>
						<div class="wrap">Prix (TTC) : 9.99 EUR (<small>7.99<sup>HT</sup>)</small></div>
						<div class="wrap">Disponible</div>
						<div class="mark-wrap wrap"><div class="mark" style="width:60%"></div></div>
					</div>
				</div>
				<div class="txtcenter">
					<a href="#add" class="button green ecom-ic cartadd">Ajouter au panier</a>
				</div>
				
				<div class="title">Description</div>
				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
				
				<div class="title">Commentaire(s)</div>
				<div class="comment">
					<div class="row">
						<div class="col huge">#1 - <b>User01</b></div>
						<div class="col tiny txtright">
							<div class="mark-wrap"><div class="mark" style="width:60%"></div></div>
						</div>
					</div>
					<div class="txtjustify">
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</p>
					</div>
				</div>
				<div class="comment">
					<div class="row">
						<div class="col huge">#2 - <b>Toto</b></div>
						<div class="col tiny txtright">
							<div class="mark-wrap"><div class="mark" style="width:60%"></div></div>
						</div>
					</div>
					<div class="txtjustify">
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</p>
					</div>
				</div>
				
				<div class="title">Poster un commentaire</div>
				<!--<div class="notice info"><p>Pour poster un commentaire vous devez être connecté.</p></div>-->
				<form action="#" method="post">
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
						<label for="msg">Commentaire</label>
						<textarea rows="5" cols="60" name="msg" id="msg"></textarea>
					</div>
					<div class="form-action txtcenter">
						<input type="submit" value="Poster le commentaire" class="fill" />
					</div>
				</form>
				
<?php include(APPPATH . 'views/foot.php'); ?>
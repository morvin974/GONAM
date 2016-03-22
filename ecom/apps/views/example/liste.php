<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/head.php');
?>

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
				
				<table>
					<tr><th>Aperçu</th><th>Article</th><th>Note</th><th>Prix (TTC)</th><th>Dispo.</th><th style="width:15%;"></th></tr>
					<tr>
						<td class="txtcenter"><div class="art-view v-medium"><a href="#"><img src="./public/imgs/thumb.png" title="Card" /></a></div></td>
						<td><a href="#">Generiq system card</a><br /><small>Asus</small></td>
						<td class="txtcenter"><div class="mark-wrap"><div class="mark" style="width:60%"></div></div></td>
						<td class="txtcenter"><b>EUR 9.99</b></td>
						<td class="txtcenter">En stock</td>
						<td class="txtcenter"><a href="#add" class="button fill ecom-ic cartadd">Ajouter</a></td>
					</tr>
					<tr>
						<td class="txtcenter"><div class="art-view v-medium"><a href="#"><img src="./public/imgs/thumb.png" title="Card" /></a></div></td>
						<td><a href="#">Generiq system card</a><br /><small>Asus</small></td>
						<td class="txtcenter"><div class="mark-wrap"><div class="mark" style="width:60%"></div></div></td>
						<td class="txtcenter"><b>EUR 9.99</b></td>
						<td class="txtcenter">Non disponible</td>
						<td class="txtcenter"><a href="#add" class="button fill ecom-ic cartadd">Ajouter</a></td>
					</tr>
					<tr>
						<td class="txtcenter"><div class="art-view v-medium"><a href="#"><img src="./public/imgs/thumb.png" title="Card" /></a></div></td>
						<td><a href="#">Generiq system card</a><br /><small>Asus</small></td>
						<td class="txtcenter"><div class="mark-wrap"><div class="mark" style="width:70%"></div></div></td>
						<td class="txtcenter"><b>EUR 9.99</b></td>
						<td class="txtcenter">En stock</td>
						<td class="txtcenter"><a href="#add" class="button fill ecom-ic cartadd">Ajouter</a></td>
					</tr>
					<tr>
						<td class="txtcenter"><div class="art-view v-medium"><a href="#"><img src="./public/imgs/thumb.png" title="Card" /></a></div></td>
						<td><a href="#">Generiq system card</a><br /><small>Asus</small></td>
						<td class="txtcenter"><div class="mark-wrap"><div class="mark" style="width:60%"></div></div></td>
						<td class="txtcenter"><b>EUR 9.99</b></td>
						<td class="txtcenter">En stock</td>
						<td class="txtcenter"><a href="#add" class="button fill ecom-ic cartadd">Ajouter</a></td>
					</tr><tr>
						<td class="txtcenter"><div class="art-view v-medium"><a href="#"><img src="./public/imgs/thumb.png" title="Card" /></a></div></td>
						<td><a href="#">Generiq system card</a><br /><small>Asus</small></td>
						<td class="txtcenter"><div class="mark-wrap"><div class="mark" style="width:60%"></div></div></td>
						<td class="txtcenter"><b>EUR 9.99</b></td>
						<td class="txtcenter">En stock</td>
						<td class="txtcenter"><a href="#add" class="button fill ecom-ic cartadd">Ajouter</a></td>
					</tr>
					<tr>
						<td class="txtcenter"><div class="art-view v-medium"><a href="#"><img src="./public/imgs/thumb.png" title="Card" /></a></div></td>
						<td><a href="#">Generiq system card</a><br /><small>Asus</small></td>
						<td class="txtcenter"><div class="mark-wrap"><div class="mark" style="width:20%"></div></div></td>
						<td class="txtcenter"><b>EUR 9.99</b></td>
						<td class="txtcenter">En stock</td>
						<td class="txtcenter"><a href="#add" class="button fill ecom-ic cartadd">Ajouter</a></td>
					</tr>
					<tr>
						<td class="txtcenter"><div class="art-view v-medium"><a href="#"><img src="./public/imgs/thumb.png" title="Card" /></a></div></td>
						<td><a href="#">Generiq system card</a><br /><small>Asus</small></td>
						<td class="txtcenter"><div class="mark-wrap"><div class="mark" style="width:60%"></div></div></td>
						<td class="txtcenter"><b>EUR 9.99</b></td>
						<td class="txtcenter">En stock</td>
						<td class="txtcenter"><a href="#add" class="button fill ecom-ic cartadd">Ajouter</a></td>
					</tr>
					<tr>
						<td class="txtcenter"><div class="art-view v-medium"><a href="#"><img src="./public/imgs/thumb.png" title="Card" /></a></div></td>
						<td><a href="#">Generiq system card</a><br /><small>Asus</small></td>
						<td class="txtcenter"><div class="mark-wrap"><div class="mark" style="width:60%"></div></div></td>
						<td class="txtcenter"><b>EUR 9.99</b></td>
						<td class="txtcenter">En stock</td>
						<td class="txtcenter"><a href="#add" class="button fill ecom-ic cartadd">Ajouter</a></td>
					</tr>
					<tr>
						<td class="txtcenter"><div class="art-view v-medium"><a href="#"><img src="./public/imgs/thumb.png" title="Card" /></a></div></td>
						<td><a href="#">Generiq system card</a><br /><small>Asus</small></td>
						<td class="txtcenter"><div class="mark-wrap"><div class="mark" style="width:60%"></div></div></td>
						<td class="txtcenter"><b>EUR 9.99</b></td>
						<td class="txtcenter">Non disponible</td>
						<td class="txtcenter"><a href="#add" class="button fill ecom-ic cartadd">Ajouter</a></td>
					</tr>
					<tr>
						<td class="txtcenter"><div class="art-view v-medium"><a href="#"><img src="./public/imgs/thumb.png" title="Card" /></a></div></td>
						<td><a href="#">Generiq system card</a><br /><small>Asus</small></td>
						<td class="txtcenter"><div class="mark-wrap"><div class="mark" style="width:60%"></div></div></td>
						<td class="txtcenter"><b>EUR 9.99</b></td>
						<td class="txtcenter">En stock</td>
						<td class="txtcenter"><a href="#add" class="button fill ecom-ic cartadd">Ajouter</a></td>
					</tr>
				</table>
				<hr />
				<div class="pagination txtcenter">
					<a href="#">&laquo;</a><a href="#1">1</a><a href="#2">2</a><span class="active">3</span><span>&raquo;</span>
				</div>

<?php include(APPPATH . 'views/foot.php'); ?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/head.php');
?>

				<div class="title">Text</div>
				<h1>Header 1</h1>
				<p class="txtjustify">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</p>
				<h2>Header 2</h2>
				<p class="txtright">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</p>
				<h3>Header 3 </h3>
				<p class="txtcenter">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</p>
				
				<div class="title">Notice</div>
				<div class="notice info"><p>Version de développement, preview.</p></div>
				<div class="notice error"><p>Version de développement, preview.</p></div>
				<div class="notice success"><p>Version de développement, preview.</p></div>
				
				<div class="title">Form</div>
				<form action="#form" method="post">
					<div>
						<label for="text">Text field</label>
						<input type="text" name="text" id="text" size="32" />
					</div>
					<div>
						<label for="pass">Password field</label>
						<input type="password" name="text1" id="pass" size="32" />
					</div>
					<div>
						<label for="select">Simple select</label>
						<select name="select" id="select">
							<option>Example 1</option>
							<option>&vdash; Sub-example</option>
							<option>Example 2</option>
						</select>
					</div>
					<div>
						<label for="select2">Multiple select</label>
						<select name="select2" id="select2" size="5" multiple>
							<option>Example 1</option>
							<option>&vdash; Sub-example</option>
							<option>&vdash; Sub-example2</option>
							<option>&vdash; Sub-example3</option>
							<option>Example 2</option>
							<option>&vdash; Sub-example1</option>
						</select>
					</div>
					<div>
						<label for="area">Textarea</label>
						<textarea rows="6" cols="60" name="area" id="area">Lorem ipsum sit dolor amet ...</textarea>
					</div>
					<div class="form-action txtright">
						<a href="#back" class="button fill">Retour</a>
						<input type="submit" class="green" value="Envoyer" />
					</div>
				</form>
				<div class="title">Table &amp; others</div>
				<table>
					<tr><th>ID</th><th>Nom</th><th>Prenom</th><th>Action(s)</th></tr>
					<tr>
						<td class="txtcenter">1</td>
						<td>Joe</td>
						<td>Doe</td>
						<td class="txtcenter" style="width:15%">
							<a href="#add" class="button fill ecom-ic cartadd">Ajouter</a>
						</td>
					</tr>
					<tr>
						<td class="txtcenter">1</td>
						<td>Joe</td>
						<td>Doe</td>
						<td class="txtcenter" style="width:15%">
							<a href="#add" class="button fill ecom-ic cartadd">Ajouter</a>
						</td>
					</tr>
					<tr>
						<td class="txtcenter">1</td>
						<td>Joe</td>
						<td>Doe</td>
						<td class="txtcenter" style="width:15%">
							<a href="#add" class="button fill ecom-ic cartadd">Ajouter</a>
						</td>
					</tr>
					<tr>
						<td class="txtcenter">1</td>
						<td>Joe</td>
						<td>Doe</td>
						<td class="txtcenter" style="width:15%">
							<a href="#add" class="button fill ecom-ic cartadd">Ajouter</a>
						</td>
					</tr>
				</table>
				<hr />
				<table>
					<tr><th>Class</th><th>Icon</th></tr>
					<tr>
							<td>d_icon go</td>
							<td class="txtcenter"><a href="#" class="d_icon go"></a></td>
						</tr>
						<tr>
							<td>d_icon edit</td>
							<td class="txtcenter"><a href="#" class="d_icon edit"></a></td>
						</tr>
						<tr>
							<td>d_icon del</td>
							<td class="txtcenter"><a href="#" class="d_icon del"></a></td>
						</tr>
						<tr>
							<td>d_icon mail</td>
							<td class="txtcenter"><a href="#" class="d_icon mail"></a></td>
						</tr>
						<tr>
							<td>d_icon key</td>
							<td class="txtcenter"><a href="#" class="d_icon key"></a></td>
						</tr>
						<tr>
							<td>d_icon user</td>
							<td class="txtcenter"><a href="#" class="d_icon user"></a></td>
						</tr>
						<tr>
							<td>d_icon print</td>
							<td class="txtcenter"><a href="#" class="d_icon print"></a></td>
						</tr>
						<tr>
							<td>d_icon pdf</td>
							<td class="txtcenter"><a href="#" class="d_icon pdf"></a></td>
						</tr>
				</table>
				<hr />
				<div class="pagination txtcenter">
					<a href="#">&laquo;</a><a href="#1">1</a><a href="#2">2</a><span class="active">3</span><span>&raquo;</span>
				</div>

<?php include(APPPATH . 'views/foot.php'); ?>

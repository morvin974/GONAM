<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<!DOCTYPE HTML>
<html>
<head>
<title>Categorie</title>
<meta charset="UTF-8"></meta>
</head>
	<body>
		<h1>Page Catégorie</h1>
		<a href="index.php?m=Categorie&a=afficherCreerCategorie">Creer une nouvelle Categorie</a>
		<form method="post" action="index.php?m=Categorie&a=supprimerCategorie">
		<a>Supprimer une catégorie : </a>
		<SELECT name="id_category">
			<?php foreach ($data as $value) { ?>
					<option selected ><?php echo htmlentities($value->category_name);?></option>
			<?php } ?>
		</SELECT>
		<input type="submit" value="Valider" />
		</form>
		<form method="post" action="index.php?m=Categorie&a=afficherModificationCategorie">
		<a>Modifier une catégorie : </a>
		<SELECT name="id_category">
			<?php foreach ($data as $value) { ?>
					<option selected value="<?php echo htmlentities($value->id_category);?>" ><?php echo htmlentities($value->category_name);?></option>
			<?php } ?>
		</SELECT>
		<input type="submit" value="Valider" />
		</form>
	</body>
</html>	







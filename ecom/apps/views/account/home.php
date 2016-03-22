<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/head.php');
?>

<div class="title">Mon compte</div>
<ul>
	<li>Adresse E-mail : <?php echo htmlentities($user['user_mail']); ?></li>
	<li>Nom et Prénom : <?php echo htmlentities($user['user_firstname'] . ' ' . $user['user_name']) ?></li>
	<li>Nombre de commande passé : 0</li>
</ul>

<div class="title">Modifier votre mot de passe</div>
<p>Pour changer votre mot de passe veuillez remplir le formulaire ci-dessous.</p>
<?php if (hasErrorForm()) { ?>
	<div class="notice error"><?php echo getErrorForm(); ?></div>
<?php } ?>
<form action="<?php echo getURL('account', 'home'); ?>" method="post">
	<div>
		<label for="password">Mot de passe</label>
		<input type="password" name="password" id="password" maxlength="32" />
	</div>
	
	<div>
		<label for="newpwd">Nouveau mot de passe</label>
		<input type="password" name="newpwd" id="newpwd" maxlength="32" />
	</div>
	
	<div>
		<label for="confpwd">Confirmer</label>
		<input type="password" name="confpwd" id="confpwd" maxlength="32" />
	</div>
	
	<div class="form-action txtcenter">
		<input type="submit" class="green" value="Modifier" />
	</div>
</form>

<div class="title">Vos dernières commandes</div>
<?php if (empty($order)) { ?>
<div class="notice info"><p>Vous n'avez pas encore réalisé de commande sur notre site.</p></div>
<?php } else { ?>
<table>
	<tr><th>Numéro</th><th>Date</th><th>Statut</th><th>Montant (TTC)</th><th>Détails</th></tr>
	<?php foreach ($order as $data) { ?>
	<tr>
		<td class="txtcenter"><?php echo $data->id_order; ?></td>
		<td class="txtcenter"><?php echo $data->order_date; ?></td>
		<td class="txtcenter"><?php if($data->order_status==1) echo "Commande reçu"; else if($data->order_status==2) echo "Commande envoyée"; else echo "Commande en préparation"; ?></td>
		<td class="txtcenter"><?php echo $data->order_price_HT * 1.20; ?></td>
		<td class="txtcenter"><a href="index.php?m=order&a=affichageInfoOrderUser&id_order=<?php echo htmlentities($data->id_order); ?>&date=<?php echo htmlentities($data->order_date); ?>" class="d_icon go"></a></td>
	</tr>
	<?php } ?>
</table>
<?php } ?>

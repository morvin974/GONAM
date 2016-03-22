<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/admin_head.php');
?>

	<div class="data_box">
		<div class="d_title"><p>Ajout d'une entreprise</p></div>
		<div class="d_content">
			<?php if (hasErrorForm()) { ?>
				<div class="notice error"><?php echo getErrorForm(); ?></div>
			<?php } ?>
		
			<form method="post" action="<?php echo getURL("firm", "creerfirm"); ?>">
				<label>Nom</label>		
					<input type="text" name="firm_name" value="<?php echo(getPostData('firm_name'));?>"/><br />
		
				<label>Descritpion</label>
					<textarea rows="5" cols="64" name="firm_desc"><?php echo(getPostData('firm_desc')); ?></textarea><br />

				<hr />
				
				<label>Adresse</label>
					<input type="text" size="48" name="firm_adress" value="<?php echo(getPostData('firm_adress'));?>"/><br />

				<label>Ville</label>
					<input type="text" size="24" name="firm_city" value="<?php echo(getPostData('firm_city'));?>"/><br />

				<label>Code postal</label>
					<input type="text" size="6" name="firm_postcode" value="<?php echo(getPostData('firm_postcode'));?>"/><br />
					
				<hr />
				
				<label>Numéro Tél.</label>
					<input type="text" name="firm_phone" value="<?php echo(getPostData('firm_phone'));?>"/><br />
				
				<label>Fax</label>
					<input type="text" name="firm_fax" value="<?php echo(getPostData('firm_fax'));?>"/><br />

				<label>Adresse e-mail</label>
					<input type="text" size="24" name="firm_mail" value="<?php echo(getPostData('firm_mail'));?>"/><br />

				<div class="form-action">
					<a href="<?php echo getURL("firm"); ?>" class="d_button">Retour</a>
					<input type="submit" value="Ajouter l'entreprise" />
				</div>
			</form>
		</div>
	</div>
		
<?php include(APPPATH . 'views/admin_foot.php'); ?>






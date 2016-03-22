<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include(APPPATH . 'views/head.php');
?>

<div class="title">Information de contact</div>
<h2>Contact</h2>
<div class="notice info">
	<p>E-mail : <b><?php echo htmlentities($data->firm_mail); ?></b></p>
	<p>Téléphone : <b><?php echo htmlentities($data->firm_phone); ?></b></p>
	<p>Fax : <b><?php echo htmlentities($data->firm_fax); ?></b> </p>
</div>

<h2>Adresse</h2>
<div class="notice info">
	<p>
		<?php echo htmlentities($data->firm_address); ?><br />
		<?php echo htmlentities($data->firm_postcode) . ' ' . htmlentities($data->firm_city); ?>
	</p>
</div>

<h2>Plan d'accès</h2>
<div class="txtcenter">
	<iframe style="box-shadow:0 0 10px #999;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2624.7812807079627!2d2.4644079999999997!3d48.862381!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e612ae6a556ee1%3A0x6aa2df8d4d5f21d9!2s140+Rue+de+la+Nouvelle+France%2C+IUT+de+Montreuil%2C+93100+Montreuil!5e0!3m2!1sfr!2sfr!4v1422132684903" width="600" height="450" frameborder="0"></iframe>
</div>	
		
<?php include(APPPATH . 'views/foot.php'); ?>
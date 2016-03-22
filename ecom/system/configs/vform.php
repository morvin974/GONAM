<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array();

$config['debug'] = TRUE;

$config['error']['required'] 	= 'Le champ &laquo; %s &raquo; est requis.';
$config['error']['notEmpty'] 	= 'Le champ &laquo; %s &raquo; ne peut pas être vide.';
$config['error']['matches'] 	= 'Les champs &laquo; %s &raquo; et &laquo; %s &raquo; ne correspondes pas.';
$config['error']['minLength'] 	= 'Le champ &laquo; %s &raquo; doit comporter au moins %s caractère(s).';
$config['error']['maxLength'] 	= 'Le champ &laquo; %s &raquo; ne peut pas comporter plus de %s caractère(s).';
$config['error']['exactLength'] = 'Le champ &laquo; %s &raquo; doit comporter %s caractère(s).';
$config['error']['isNumeric'] 	= 'Le champ &laquo; %s &raquo; ne peut contenir que des valeurs numérique.';
$config['error']['isInt'] 		= 'Le champ &laquo; %s &raquo; ne peut contenir ques des valeurs entières.';
$config['error']['gt']	 		= 'Le champ &laquo; %s &raquo; ne peut pas contenir de valeur en-dessous de %s.';
$config['error']['lt'] 			= 'Le champ &laquo; %s &raquo; ne peut pas contenir de valeur au-dessus de %s.';
$config['error']['alpha'] 		= 'Le champ &laquo; %s &raquo; ne peut contenir que des lettres.';
$config['error']['alphaNum']	= 'Le champ &laquo; %s &raquo; ne peut contenir que des chiffres et des lettres.';
$config['error']['alphaExt']	= 'Le champ &laquo; %s &raquo; ne peut contenir que des chiffres, lettres ou &laquo;-&raquo;, &laquo; &raquo;, &laquo_&raquo;';

$config['error']['default'] = 'Une erreur est survenu lors de la validation du formulaire.';

<?php
//------connexion a la base de donnée---------------
$pdo = new PDO('mysql:host=localhost;dbname=lokisalle', 'root', '',
	array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND =>
		'SET NAMES utf8'));
//var_dump($pdo);
//constante------------
define("URL","http://localhost/phpsql/lokisalle/");
define("RACINE",$_SERVER['DOCUMENT_ROOT'] . 'phpsql/lokisalle/');
//echo 'url :' . URL .'<br>';
//echo 'racine :'. RACINE .'<br>';
//----------------variable--------------
$content ='';
//------------ fonctions-------------------------
require_once('fonction.inc.php');

//session----------
session_start();
/* 
l'objet PDO me permet d'assurer la connexion entre la base et le site
	nous auront besoin d'a&fficher des produit de la bas ect
- la constante URL permet d'annoncer l'adresse web du site
l'adresse web du site peut changer (lors d'une mise en ligne)
il seras preferable de modifié la constante plutot que chaques lignes 1 par 1

la constante racine permet d'annoncer le chemin systeme du site
	ce chemin sera indispensable lorsque nous voudrons afficher
	en passant par la variable $content (plutot que echo) cela nous permettras de choisir precisement l'emplacement 
	des messages à afficher (on ne veut pas faire de echo au dessu du doctype).

	notre fichier fonction contiendras des fonctions permettant de nous facilité le developpement  dans un site web, il arrive regulierement que nous devions realisé des print_r, var_dump ou l'extention de requete.*/
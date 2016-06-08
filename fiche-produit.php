<?php

if (!isset($_GET['id_produit']))
{
	header('location:' . URL .'?page=accueil');
}
//------------------------------------------------------------------------------
// SELECT * FROM produit WHERE id_produit='$_GET[id_produit]'

$r = $pdo->query("

	SELECT s.*, p.*
	FROM salle s, produit p
	WHERE s.id_salle = p.id_salle
	AND p.id_produit = '$_GET[id_produit]';

		");

if($r->rowCount() <= 0)
{
	header('location:' . URL .'?page=accueil');
}

//----------------------------------------------------------------------------
$produit = $r->fetch(PDO::FETCH_ASSOC);
// debug($produit);

$content .= '<strong>Salle : </strong>' . $produit['titre'] .'<br>'.
			'<img src="' . $produit['photo'] . '"><br>'.
			'<strong>Descrition : </strong>' . $produit['description'] .'<br><br>'.
			'<strong>Localisation : </strong><br><iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=' . $produit['adresse'] . $produit['ville'] . $produit['cp'] . '&amp;ie=UTF8&amp;&amp;output=embed"></iframe><br />
'. '<br>'.
			'<strong>Adresse : </strong>' . $produit['adresse'] .' '. $produit['cp'] .' '. $produit['ville'] .'<br>'.
			'<strong>Date d\'arrivée : </strong>' . $produit['date_arrivee'] .'<br>'.
			'<strong>Date de départ : </strong>' . $produit['date_depart'] .'<br>'.
			'<strong>Capacité : </strong>' . $produit['capacite'] .'<br>'.
			'<strong>Catégorie : </strong>' . $produit['categorie'] .'<br>'.
			'<strong>Tarif : </strong>' . $produit['prix'] .'<br><br>'.

//----------------AFFICHAGE AUTRES PRODUITS-------------------------------------
			'<h3>Autres produits :</h3>';

$r = $pdo->query("
	SELECT s.*,p.*
	FROM salle s, produit p 
	WHERE s.id_salle = p.id_salle
	");

while($produit2 =  $r->fetch(PDO::FETCH_ASSOC))
{
	global $produit;
	if($produit2['id_produit'] != $produit['id_produit'] )
	$content.= '<a href="?page=fiche-produit&id_produit='. $produit2['id_produit'] .'"><img src="' . $produit2['photo'] . '"></a>' . '  ';
}


?>
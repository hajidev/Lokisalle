<?php

//--------------------- Suppression d'un produit ----------------------------------------
if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
	execute_requete(" DELETE FROM produit WHERE id_produit=$_GET[id_produit] ");
}


//----------------------------- Affichage des produits ----------------------------------
$resultat = execute_requete('SELECT * FROM produit');

$content .= '<table class="table"><tr>' ;
for($i=0; $i < $resultat->columnCount(); $i++)
{
	$colonne = $resultat->getColumnMeta($i);
	$content .= "<th>$colonne[name]</th>";
}
$content .= '<th>Action</th>';
$content .= '</tr>';
while ($produits = $resultat->fetch(PDO::FETCH_ASSOC))
{
	$content .='<tr>';
	foreach ($produits as $indice => $valeur)
	{
		if ($indice == 'photo')
			$content .= "<td><img src=\"$valeur\" class=\"image-back-office\"</td>";
		
		else
			$content .= "<td>$valeur</td>";	
	}
	$content .= '<td>
	<a href="'.URL.'?page=fiche-produit&id_produit='. $produits['id_produit'] . '"><span class="glyphicon glyphicon-search"></span></a>
	<a href="?page=gestion-des-produits&action=suppression&id_produit='. $produits['id_produit'] . '" onClick="return(confirm(\'En êtes vous certain ?\'))"><span class="glyphicon glyphicon-trash"></span></a></td>';


	$content .= '</tr>';
}
$content .= '</table>';

//------------------------------------------INSERTION PRODUITS------------------------------

if($_POST)
{
	debug($_POST);
	execute_requete("INSERT INTO produit (date_arrivee, date_depart, id_salle, prix) VALUES ('$_POST[date_arrivee]', '$_POST[date_depart]', '$_POST[id_salle]', '$_POST[tarif]')");
}

$content .= '
<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		<label for="date_arrivee">Date d\'arrivée</label>
		<input type="date" name="date_arrivee" class="form-control">
	</div>
	<div class="form-group">
		<label for="date_depart">Date de départ</label>
		<input type="date" name="date_depart" class="form-control">
	</div>
	<div class="form-group">
		<label for="salle">Salle</label>
		<Select name="id_salle" class="form-group">';
			
			$resultat = execute_requete('SELECT * FROM salle');
			while($salle = $resultat->fetch(PDO::FETCH_ASSOC))
			{
				$content.='<option value='.$salle['id_salle'].'>';
				//var_dump($salle);
				$content .= $salle['id_salle'] . ' ' .  $salle['titre'] . ' ' .  $salle['adresse'] . ' ' . $salle['ville'] . ' ' . $salle['cp'];

				$content.='</option>';
			}
			$content.='</select>
	</div>
	<div class="form-group">
		<label for="tarif">Tarif</label>
		<input type="text" name="tarif" class="form-control">
	</div>
	
	<div class="form-group">
		<input type="submit" value="Enregistrer">
	</div>
</form>';
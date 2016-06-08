<?php
//----------------recuperation du post----------------------
if ($_POST)
 {
	
	execute_requete("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, statut,date_enregistrement ) VALUES('$_POST[pseudo]','$_POST[mdp]','$_POST[nom]','$_POST[prenom]','$_POST[email]','$_POST[civilite]','$_POST[statut]', NOW())");
		$content .= '<div class="alert alert-success">le membre a bien été ajouté ;) !</div>';
}
//------------------------supression------------------------
if(isset($_GET['action'])){

	execute_requete("DELETE FROM membre WHERE id_membre = $_GET[id_membre]");
}
//--------------creation des colones-----------------------------
$resultat = $pdo-> query('SELECT * FROM membre');

$content .= '<table class="table"><tr>';

for($i = 0;$i < $resultat->ColumnCount();$i++){
	$colonne = $resultat->getcolumnMeta($i);
	$content .="<th>$colonne[name]</th>";
}
$content .= '<th>Action</th>';
$content .= '</tr>';

//-----------------insertions des produits dans le tableau---------------------------
while ($membre = $resultat -> fetch(PDO::FETCH_ASSOC)){
	$content .= '<tr>';

	foreach ($membre as $indice => $valeur) {

		$content .= "<td>$valeur</td>";

	}

	$content .= '<td><a href="?page=gestion-des-membres&action=suppression&id_membre=' . $membre['id_membre'] . '"onClick="return(confirm(\'En etes vous certain?\'))"><span class="glyphicon glyphicon-trash"></span></a></td>';
	$content .= '</td>';
}

$content .= '</table>';

//----------------------------------formulaire-------------------------------
?>
<?php
$content.='
<form method="post" action="" enctype="multipart/form-data">
<div class="form-group">
	<label for="pseudo">pseudo</label>
	<input type="text" name="pseudo"  class="form-control">
</div>
<div class="form-group">
	<label for="mdp">mot de passe</label>
	<input type="text" name="mdp" class="form-control">
	</div>
<div class="form-group">
	<label for="nom">nom</label>
	<input type="text" name="nom"  class="form-control">
	</div>
<div class="form-group">
	<label for="prenom">prenom</label>
	<input type="textarea" name="prenom" class="form-control">
	</div>
<div class="form-group">
	<label for="email">email</label>
	<input type="email" name="email"  class="form-control">
	</div>

<div class="form-group">
	<label for="civilite">civilite</label>
	<select name="civilite" class="form-control">
		<option value="f">Femme</option>
		<option value="h">Homme</option>
	</select>
	</div>

	<div class="form-group">
	<label for="statut">statut</label>
	<select name="statut" class="form-control">
		<option value="admin">admin</option>
		<option value="membre">membre</option>
	</select>
	</div>

<div class="form-group">
	<input type="submit" value="enregistrer" class="form-control">
	</div>
</form>';
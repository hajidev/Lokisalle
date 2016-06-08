<?php
$condition = '';
//=========================FORMULAIRE===================================
$content .='<div class="col-md-2">
	<form method ="post" action="" enctype="multipart/form-data">
				<div class="form-group">
                  <label for="categorie">Catégorie: </label>
                  <select name="categorie" class ="form-control">
                      <option value="reunion">Réunion</option>
                      <option value="bureau">Bureau</option>
                      <option value="formation">Formation</option>
                  </select>
               
              </div>
              <div class="form-group">
                  <label for="ville">Ville: </label>
                  <select name="ville" class ="form-control">
                      <option value="Paris">Paris</option>
                      <option value="Lyon">lyon</option>
                      <option value="Marseille">Marseille</option>
                  </select>
                 
              </div>
              <div class="form-group">
                  <label for="capacite">Capacité: </label>
                  <select name="capacite" class ="form-control">
                      <option value="30">30</option>
                      <option value="50">50</option>
                      <option value="100">100</option>
                  </select>
                
              </div>
              <div class="form-group">
              <label for="prix">Prix <em>(max)</em>: </label>
              <input type="range" name="prix" value="15" max="2000" min="0" step="5" id="monprix">
              	<label for="monprix"></label>
              </div>
              <input type="submit" value="Envoyer">
            </form>
		</div>';
// =============== RECHERCHE PARTICULIERE ===============================
if($_POST)
{
	$condition .= (isset($_POST['prix'])) ? " AND p.prix<='$_POST[prix]'" : '';
	$condition .= (isset($_POST['categorie'])) ? " AND s.categorie='$_POST[categorie]'" : '';
	$condition .= (isset($_POST['ville'])) ? " AND s.ville='$_POST[ville]'" : '';
	$condition .= (isset($_POST['capacite'])) ? " AND s.capacite='$_POST[capacite]'" : '';
}

$r = $pdo->query("SELECT s.*,p.* FROM salle s, produit p 	WHERE s.id_salle = p.id_salle	$condition	");
// debug($r);
$content .= '<div class="col-md-9 col-md-offset-1"><strong>' . $r->rowCount() . ' résultat(s)</strong><hr>';
// =================== AFFICHAGE DES PRODUITS ===========================
	while($resultat =  $r->fetch(PDO::FETCH_ASSOC)){
	$content.='<div id="presentation">';
	$content.= '<h1>'.$resultat['titre'].'</h1><br>';
	$content.= '<p>'.$resultat['description'].'</p><br>';
	$content.= '<p>'.$resultat['prix'] .'euros</p><br>';
	$content.= "<img src=\"$resultat[photo]\">";
	$content.='<a href="?page=fiche-produit&id_produit='.$resultat['id_produit'].'"> voir plus cliquez ici </a>';
	$content.='</div>';
}
$content .= '</div>';
<meta charset="utf-8">
<?php 

$erreur='';
if($_POST){

  if(!empty($_FILES['photo']['name']))
  {
    
    $photo_bdd=URL."img/$_POST[titre]_".$_FILES['photo']['name'];

    $photo_dossier=RACINE."img/$_POST[titre]_".$_FILES['photo']['name'];

    copy($_FILES['photo']['tmp_name'], $photo_dossier);



  }
  if(empty($_POST['titre'])|| empty($_POST['description'])||empty($_POST['capacite'])|| empty($_POST['categorie'])|| empty($_POST['prix'])|| empty($_POST['pays']) || empty($_POST['ville']) || empty($_POST['adresse']) || empty($_POST['code_postal'])){

      // Si tous les champs ne sont pas remplis on envoie le $message suivant:
      $content.= '<div class="alert alert-danger">  tous les champs sont requis ! </div>';
  }else{

    // if() si le titre existe déjà, message => "Cette salle est déjà présente dans la base".
    // else INSERT.

    $pdo->query("INSERT INTO salle (titre, description, photo, capacite, categorie, pays, ville, adresse, cp)
   VALUES ('$_POST[titre]','$_POST[description]','$photo_bdd','$_POST[capacite]', '$_POST[categorie]','$_POST[pays]','$_POST[ville]','$_POST[adresse]','$_POST[code_postal]')");

    header('location:?page=gestion-des-salles');

    //$content.= '<div class="alert alert-success"> Le produit a bien été ajouté ! </div>';
  }

  




}

//------------------------supression------------------------
if(isset($_GET['action'])){

  execute_requete("DELETE FROM salle WHERE id_salle = $_GET[id_salle]");
}
//--------------creation des colonnes-----------------------------
$resultat = $pdo-> query('SELECT * FROM salle');

$content .= '<table class="table"><tr>';

for($i = 0;$i < $resultat->ColumnCount();$i++){
  $colonne = $resultat->getcolumnMeta($i);
  $content .="<th>$colonne[name]</th>";
}
$content .= '<th>Action</th>';
$content .= '</tr>';

//-----------------insertion des produits dans le tableau---------------------------
while ($salle = $resultat -> fetch(PDO::FETCH_ASSOC)){
  $content .= '<tr>';

  foreach ($salle as $indice => $valeur) {

   
    if($indice == 'photo')
    {      
      if(empty($valeur))
      {
         $content.= '<td>pas de photo</td>';
      }
      else
      {
         $content.="<td><img src=\"$valeur\" class=\"image-back-office\"></td>";
      }
    }
    else{
      $content.="<td>$valeur</td>";
    }

  }


  $content .= '<td><a href="?page=gestion-des-salles&action=suppression&id_salle=' . $salle['id_salle'] .'"onClick="return(confirm(\'En etes vous certain?\'))"><span class="glyphicon glyphicon-trash"></span></a></td>';
  $content .= '</td>';
}

$content .= '</table>';


$content .='
            <form method ="post" action="" enctype="multipart/form-data">

              <div class="form-group">
            
                  <label for="titre">Titre*: </label>
                  <input type ="text" name="titre" list="cat" class="form-control" placeholder="Titre">
              </div>

              <div class="form-group">
                  <label for="description">Description*: </label>
                  <textarea id="description" name="description" class="form-control" placeholder="Description"></textarea>
              </div>

              <div class="form-group">
                  <label for="photo">Photo*: </label>
                  <input type ="file" name="photo" class="form-control">
              </div>

              <div class="form-group">
                  <label for="capacite">Capacité*: </label>
                  <select name="capacite" class ="form-control">
                      <option value="30">30</option>
                      <option value="50">50</option>
                      <option value="100">100</option>
                  </select>

              </div>

              <div class="form-group">
                  <label for="categorie">Catégorie*: </label>
                  <select name="categorie" class ="form-control">
                      <option value="Réunion">Réunion</option>
                      <option value="Bureau">Bureau</option>
                      <option value="Formation">Formation</option>
                  </select>

              </div>

              <div class="form-group">
                  <label for="prix">Prix*: </label>
                  <input type ="text" name="prix" list="cat" class="form-control" placeholder="Prix">
              </div>

              <div class="form-group">
                  <label for="pays">Pays*: </label>
                  <input type ="text" name="pays" list="cat" class="form-control" placeholder="Pays" >
              </div>
              <div class="form-group">
                  <label for="ville">Ville*: </label>
                  <input type ="text" name="ville" list="cat" class="form-control" placeholder="Ville">
              </div>
              <div class="form-group">
                  <label for="adresse">Adresse*: </label>
                  <textarea id="adresse" name="adresse" class="form-control" placeholder="Adresse"></textarea>
              <div>
              <div class="form-group">
                  <label for="code_postal">Code Postal*: </label>
                  <input type ="text" name="code_postal" list="cat" class="form-control" placeholder="Code Postal">
              </div>

              <input type="submit" value="Envoyer">

          </form>
          ';

?>
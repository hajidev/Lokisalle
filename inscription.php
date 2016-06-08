
<?php

if($_POST){
//---------------------------controle si les champs sont remplis---------------------

		$erreur='';

	if(empty($_POST['pseudo'])||empty($_POST['mdp'])||empty($_POST['nom'])||empty($_POST['prenom'])||empty($_POST['email'])||empty($_POST['civilite'])){

//--------------------------------alert en cas de champs non rempli----------------------

		$erreur.= '<div class="alert alert-danger">il faut remplir tous les champs !</div>';

//-----------------------------verification du pseudo-----------------------------------------

	}if(strlen($_POST['pseudo']) <= 3 || strlen($_POST['pseudo']) > 20){

		$erreur.= '<div class="alert alert-danger">votre pseudo ne rempli pas les conditions !</div>';

	//-------------empecher l'utilisation de caractere spéciaux dans le pseudo-------------------------------

	}if(!preg_match('#^[a-zA-Z0-9._-]+$#',$_POST['pseudo'])){

		$erreur.= '<div class="alert alert-danger">erreur caractere pseudo!</div>';

	
	}
	//-------------verification si le pseudo est disponible dans la base-----------------
	$result= execute_requete("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");
	if($result->rowCount()>0){

		$erreur.= '<div class="alert alert-danger">pseudo indisponible!</div>';
	}
//---------envoie du formulaire si les champs sont remplis-------------------------
	if(empty($erreur)){
		$_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_DEFAULT);//cryptage du mot de passe
		execute_requete("INSERT INTO membre(pseudo,mdp,nom,prenom,email,civilite,date_enregistrement) VALUES('$_POST[pseudo]','$_POST[mdp]','$_POST[nom]','$_POST[prenom]','$_POST[email]','$_POST[civilite]',NOW())");

		//redirection vers l'url du site (index) > la page connexion
		header('location:'.URL.'?page=connexion&inscription=ok');
		//$content .= '<div class="alert alert-success">vous avez bien été ajouté ;) !</div>';

	};
	$content.=$erreur;
};




//------------------------formulaire---------------------------
 $pseudo = (isset($_POST['pseudo'])) ? $pseudo= $_POST['pseudo'] : '';
 // variable = (condition)        ?=if                          : else

 $mdp = (isset($_POST['mdp'])) ? $mdp= $_POST['mdp'] : '';
 $nom = (isset($_POST['nom'])) ? $nom= $_POST['nom'] : '';
 $prenom = (isset($_POST['prenom'])) ? $prenom= $_POST['prenom'] : '';
 $email = (isset($_POST['email'])) ? $email= $_POST['email'] : '';
 $civilite = (isset($_POST['civilite'])) ? $_POST['civilite'] : '';



?>

<?php
$content.='
<form method="post" action="" enctype="multipart/form-data">
<div class="form-group">
	<label for="pseudo">pseudo</label>
	<input type="text" name="pseudo"  class="form-control" value="'.$pseudo.'">
</div>
<div class="form-group">
	<label for="mdp">mot de passe</label>
	<input type="text" name="mdp" class="form-control" value="'.$mdp.'">
	</div>
<div class="form-group">
	<label for="nom">nom</label>
	<input type="text" name="nom"  class="form-control" value="'.$nom.'">
	</div>
<div class="form-group">
	<label for="prenom">prenom</label>
	<input type="textarea" name="prenom" class="form-control" value="'.$prenom.'">
	</div>
<div class="form-group">
	<label for="email">email</label>
	<input type="email" name="email"  class="form-control" value="'.$email.'">
	</div>

<div class="form-group">
	<label for="civilite">civilite</label>
	<select name="civilite" class="form-control">
		<option value="f"'; if($civilite == 'f') $content.= ' selected'; $content .='>Femme</option>
		<option value="m"'; if($civilite == 'm') $content.= ' selected'; $content .='>Homme</option>
	</select>
	</div>

<div class="form-group">
	<input type="submit" value="enregistrer" class="form-control">
	</div>
</form>';
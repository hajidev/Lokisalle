<?php
//--------------------------------deconnexion si besoin-------------------------------------
if(isset($_GET['action'])){

unset($_SESSION['membre']);

$content .= '<div class="alert alert-success">vous avez bien été déconnecté !</div>';
}
//----------redirection vers la page profil si l''utilisateur est deja connecté-------------------

if(isset($_SESSION['membre'])){//si la session m'embre n'existe pas..

header('location:'.URL.'?page=espace_membre');

}

//------------------prevenir les internautes sortant du formulaire que leur inscription est validée---------------------------------
 if(isset($_GET['inscription'])){

$content .= '<div class="alert alert-success">vous avez bien été ajouté ;) !</div>';

}

//---------------------formulaire de connexion------------------------------
if($_POST){
	
	$r=$pdo->query("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");

	if($r->rowCount() != 0){
	
      $content .= '<div class="alert alert-success">pseudo ok</div>';

      	$membre= $r-> fetch(PDO::FETCH_ASSOC); 

      
      	if(password_verify($_POST['mdp'], $membre['mdp'])){
      		
      		//remplissage de la session------------------
      		$_SESSION['membre']['pseudo'] = $membre['pseudo'];
      		$_SESSION['membre']['nom']= $membre['nom'];
      		$_SESSION['membre']['prenom']= $membre['prenom'];
      		$_SESSION['membre']['email']= $membre['email'];
      		$_SESSION['membre']['civilite']= $membre['civilite'];
      		$_SESSION['membre']['statut']= $membre['statut'];

//---------------------------redirection ver la page profil--------------------

      		header('location:'.URL.'?page=espace_membre');

      	}else{

      		//erreur mdp
      		$content .= '<div class="alert alert-danger">erreur MDP</div>';
      	}

	}else{
		//erreur pseudo
		$content .= '<div class="alert alert-danger">erreur pseudo</div>';
	}
}
//--------------------------------------------------------------------------
$content.= 'BONJOUR ET BIENVENUE SUR LA PAGE DE CONNEXION';

$content.='
<div class="col-md-3">
<form method="post" action="" enctype="multipart/form-data">
<div class="form-group">
	<label for="pseudo">pseudo</label>
	<input type="text" name="pseudo" maxlength="20" class="form-control" ">
</div>
<div class="form-group">
	<label for="mdp">mdp</label>
	<input type="password" name="mdp" maxlength="60"class="form-control" ">
	</div>
	<div class="form-group">
	<input type="submit" value="Se connecter" class="form-control">
	</div>
</form>
</div>';



?>
<?php require_once('inc/init.inc.php'); ?>
<?php
if($_GET){
  if(file_exists($_GET['page'].'.php'))/*si le fichier existe on l'inclus*/
    require_once($_GET['page'] . '.php');//on le charge
}
elseif(!isset($_GET['page']))
{
    require_once('accueil.php');//on le charge
}
else{//sinon (on ne trouve pas le fichier)
  $content .= '<div class="alert alert-danger">la demande n\'a pas pu aboutir</div>';
  }


  ?>
  <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>lokisalle</title>
    <link href="<?= URL; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= URL; ?>/ibox/skins/lightbox/lightbox.css" type="text/css" 
media="screen"/>
    <link rel="stylesheet" href="<?= URL; ?>/css/style.css">
  </head>

  <body>

    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= URL; ?>">lokisalle</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">

                        <!-- membre -->
 
            <?php   if(isset($_SESSION['membre'])){ ?>

            <li class=""><a href="?page=salles">salles</a></li>
            <li><a href="?page=reserver">reserver</a></li>
            <li><a href="?page=espace_membre">Espace Membre</a></li>
            <li><a href="?page=connexion&action=deconnection">Deconnexion</a></li>

              <?php }else{?>
                          <!-- visiteur -->
            <li class=""><a href="?page=salles">salles</a></li>
            <li><a href="?page=reserver">reserver</a></li>
            <li><a href="?page=connexion" rel="ibox">Connexion</a></li>
            <li class=""><a class="iframe" href="?page=inscription" rel="ibox"  >S'inscrire</a></li>
             <?php      }  ?>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">
        <h1>Front Office</h1>
        <?= $content; ?>
      </div>

    </div><!-- /.container -->

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="<?= URL; ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= URL; ?>/ibox/ibox.js"></script>
<script type="text/javascript">
iBox.padding = 50;
iBox.inherit_frames = false;
</script>
<script src="<?= URL; ?>/js/script.js"></script>
  </body>
</html>
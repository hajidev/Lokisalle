<?php require_once('../inc/init.inc.php'); ?>
<?php

if($_GET){
  if(file_exists($_GET['page'].'.php'))
  require_once($_GET['page'] . '.php');
else
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

    <title>BackOffice</title>

    <link href="<?= URL; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= URL; ?>/css/style.css">
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= URL; ?>admin/">BackOffice lokisalle</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="?page=gestion-des-salles">Gestion des salles</a></li>
            <li><a href="?page=gestion-des-membres">Gestion des membres</a></li>
            <li><a href="?page=gestion-des-produits">Gestion des produits</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">
        <h1>Back Office</h1>
        <?= $content; ?>
      </div>

    </div><!-- /.container -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="<?= URL; ?>/js/bootstrap.min.js"></script>
  </body>
</html>
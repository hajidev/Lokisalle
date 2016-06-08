<?php
function debug($d, $mode=1){
	echo '<div style="background: orange;padding:5px;position:absolute;
	bottom:0;right:0; z-index:1000;position:fixed;">';
	$trace = debug_backtrace();
	echo 'debug demander dans le fichier '. $trace[0]['file'].'</strong> a la ligne<strong>'. $trace[0]['line'].'</strong>.';
	if($mode == 1){

	echo '<pre>'; print_r($d); echo '</pre>';
					}else{
						var_dump($d);
					}
	echo '</div>';
}
/*debug est une fonction  permettant de nous faciliter l'exploration de variable en automatisant le print r et le var_dump
notre fonction attend 2 arguments:
1 la variable a explorer
2 le mode (1 ou autre chose)
debug_backtrace est tres utile car il nous donne des infos sur notre fonction le fichier et la ligne a laquelle est executé la fonction debug
dans un prjet avec 150 fichiers et 5000 lignes par fichier , nous gagnerons
du temps pour localiser les differents debug qui auront été ecrit.*/
//----------------------------------------------------------------------
function execute_requete($req){
	global $pdo;
	$result = $pdo->query($req);
	return $result;
	//........
}
/* execute requete est une fonction permetant d'executer une requete, elle attend
la requete a executer, pour se faire nous avons besoin de recuperer l'objet PDO utiliser dans l'espace globale
donc nous allons utiliser le mot clé globale pour l'importer dans la fonction
$pdo->query permet d'executer une requete (l'argument que l'on auras recu
il faut une requete valide.
nous prevoyons une variable $result dans le cas des requetes de selection
nous aurons des resultats a recuperer
nous retournon,(return) ces resultats. */
//............
//phase de test

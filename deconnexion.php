<?php
	include('includes/connexion.inc.php');
	include('includes/verif_util.inc.php');

	//Déconnecte uniquement si l'utilisateur a le cookie.
	if($connect == true){
		setcookie("connexion","$sid",-3600);
		header('Location: index.php');
	}else{
		header('Location: index.php');
	}

?>
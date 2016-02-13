<?php
	include('includes/connexion.inc.php');
	include('includes/header.inc.php');
	include('includes/verif_util.inc.php');
?>

<form action="inscription.php" method="post">
		<div class="clearfix">
			<label for="nom">Nom:</label>
			<input name="nom" size="255" type="text">
		</div>
		<div class="clearfix">
			<label for="prenom">Prenom:</label>
			<input name="prenom" size="255" type="text">
		</div>
		<div class="clearfix">
			<label for="email">Adresse Email:</label>
			<input name="email" size="255" type="email">
		</div>
		<div class="clearfix">
			<label for="mdp">Mot de passe:</label>
			<input name="mdp" size="255" type="password">
		</div>
		<div class="clearfix">
			<label for="mdpCheck">Confirmation mot de passe:</label>
			<input name="mdpCheck" size="255" type="password">
		</div>
		<input class="btn btn-primary" name="envoi" type="submit" value="Enregistrer">
	</form>

<?php
	//Redirige l'utilisateur sur l'accueil si il est déjà connecté.
	if($connect == true){
		header('Location:index.php');
	}else{
		if(isset($_POST['envoi'])){
			//On vérifie que tout les champs sont rempli.
			$isFilled = array('nom', 'prenom', 'email', 'mdp', 'mdpCheck');
			$error = false;
			foreach($isFilled as $check){
				if(empty($_POST[$check])){
					$error = true;
				}
			}
			
			//Si true alors un champs n'est pas rempli.
			//Sinon, on vérifie la validité des données passé.
			if($error == true){
				echo '<div class="alert alert-warning">
						<strong>Tout les champs doivent être rempli.</strong>
				</div>';
			}
		}
	}

	include('includes/footer.inc.php');
?>
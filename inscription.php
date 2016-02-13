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
			//On sécurise les variables post des injections SQL/JS.
			$nom = mysql_real_escape_string(htmlspecialchars($_POST['nom']));
			$prenom = mysql_real_escape_string(htmlspecialchars($_POST['prenom']));
			$email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
			$mdp = mysql_real_escape_string(htmlspecialchars(md5($_POST['mdp'])));
			$mdpCheck = mysql_real_escape_string(htmlspecialchars(md5($_POST['mdpCheck'])));
			
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
			}else{
				//Vérifie que l'adresse email est valide.
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					echo 'Erreur: Votre adresse e-mail est invalide.';
				}else{
					//On vérifie que le MDP et la Confirmation sont identique.
					if($mdp != $mdpCheck){
						echo '<div class="alert alert-warning">
							<strong>Le mot de passe et la confirmation mot de passe doivent être identique.</strong>
						</div>';
					}else{
						//Une fois que tout les champs sont validé, on insère l'utilisateur dans la BDD.
						$inscription = mysql_query("INSERT INTO utilisateurs(email, mdp, nom, prenom) VALUES ('$email', '$mdp', '$nom', '$prenom');");
						echo '<div class="alert alert-success">
								<strong>'.utf8_encode("Votre compte à bien été créé.Vous pouvez vous connecté").' <a href="connexion.php">ici</a>.</strong> 
							</div>';
					}
				}
			}
		}
	}

	include('includes/footer.inc.php');
?>
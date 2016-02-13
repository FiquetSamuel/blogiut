<?php
	//La plupart (tous?) les messages d'erreurs sont stock�s dans une variable d� � divers probl�me d'encodage.
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
	//Redirige l'utilisateur sur l'accueil si il est d�j� connect�.
	if($connect == true){
		header('Location:index.php');
	}else{
		if(isset($_POST['envoi'])){
			//On s�curise les variables post des injections SQL/JS.
			$nom = mysql_real_escape_string(htmlspecialchars($_POST['nom']));
			$prenom = mysql_real_escape_string(htmlspecialchars($_POST['prenom']));
			$email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
			$mdp = mysql_real_escape_string(htmlspecialchars(md5($_POST['mdp'])));
			$mdpCheck = mysql_real_escape_string(htmlspecialchars(md5($_POST['mdpCheck'])));
			
			//On cr�e un tableau de cha�nes des noms des inputs qui doivent �tre rempli.
			//On v�rifie ainsi dans un foreach que chaque $_POST n'est pas vide.
			$isFilled = array('nom', 'prenom', 'email', 'mdp', 'mdpCheck');
			$error = false;
			foreach($isFilled as $check){
				if(empty($_POST[$check])){
					$error = true;
				}
			}
			
			//Si true alors un champs n'est pas rempli.
			//Sinon, on v�rifie la validit� des donn�es pass�.
			if($error == true){
				$errorFilled = utf8_encode('<div class="alert alert-warning">
						<strong>Tout les champs doivent �tre rempli.</strong>
				</div>');
				echo $errorFilled;
			}else{
				//V�rifie que l'adresse email est valide.
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					echo 'Erreur: Votre adresse e-mail est invalide.';
				}else{
					//On v�rifie maintenant que l'email pass� n'existe pas d�j� dans la base de donn�es.
					$emailCheck = mysql_query("SELECT email FROM utilisateurs WHERE email='$email';");
					if(mysql_num_rows($emailCheck) == 1){
						$emailError = utf8_encode('<div class="alert alert-warning">
							<strong>L\'adresse email est d�j� utilis�. Saisissez en une autre.</strong>
						</div>');
						echo $emailError;						
					}else{
						//On v�rifie que le MDP et la Confirmation sont identique.
						if($mdp != $mdpCheck){
							$errorMdp = utf8_encode('<div class="alert alert-warning">
								<strong>Le mot de passe et la confirmation mot de passe doivent �tre identique.</strong>
							</div>');
							echo $errorMdp;
						}else{
							//Une fois que tout les champs sont valid�, on ins�re l'utilisateur dans la BDD.
							$inscription = mysql_query("INSERT INTO utilisateurs(email, mdp, nom, prenom) VALUES ('$email', '$mdp', '$nom', '$prenom');");
							echo '<div class="alert alert-success">
									<strong>'.utf8_encode("Votre compte � bien �t� cr��.Vous pouvez vous connect�").' <a href="connexion.php">ici</a>.</strong> 
								</div>';
						}
					}
				}
			}
		}
	}

	include('includes/footer.inc.php');
?>
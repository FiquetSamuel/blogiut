<?php
	include('includes/connexion.inc.php');
	include('includes/header.inc.php');
	include('includes/verif_util.inc.php');
	
	date_default_timezone_set('UTC');
	
	/*On défini ce qu'il faut afficher dans l'index en utilisant le statut du submit de la barre de recherche.
	Si le submit n'est pas cliqué, alors la requête à utiliser plus tard est le simple affichage des articles.
	Sinon, on affiche le résultat de la recherche lancé dans la barre de recherche.*/
	if(!isset($_POST['subRecherche'])){
		$res = mysql_query('SELECT * FROM articles ORDER BY `date` DESC;');
	}else{
		//On sécurise l'input text des différentes injections.
		$recherche = mysql_real_escape_string(htmlspecialchars($_POST['recherche']));
		
		//Je commence par séparer chaque mot clé entré dans la barre de recherche avec espace comme séparateur.
		$rechExp = explode(' ',$recherche);
		$size = sizeof($rechExp);
		
		//Je prépare la base de la requête SQL, la partie qui ne changera jamais selon les mots passé.
		$req = "SELECT * FROM articles WHERE ";
		
		//Ici, on boucle jusqu'à ce que l'on traite tout les élément ($size - 1 car le tableau commence à 0; mais sizeOf() fonctionne comme un count) 
		for($i = 0; $i <= $size-1; $i++){
			
			//Si $i est égal à size-1, cela signifie que l'on traite le dernier mot clé et donc la fin de la requête.
			if($i == $size-1){
				//On concatène la fin de la requête SQL dans la variable $req
				$req .= "titre LIKE '%$rechExp[$i]%' OR contenu LIKE '%$rechExp[$i]%' ORDER BY `date` DESC;";
			}else{
				//Sinon, on concatène le reste de la requête.
				$req .= "titre LIKE '%$rechExp[$i]%' OR contenu LIKE '%$rechExp[$i]%' OR ";
			}
		}
		//Enfin, on utilise la requête SQL que l'on vient de généré.
		$res = mysql_query("$req");
	}
	
	/*On se sert du $res que l'on a défini précédemment.
	Si il y a plus que 0 ligne, cela signifie soit que l'on affiche tout nos articles,
	soit que l'on affiche le résultat de la recherche d'article.
	Si il y a 0 ligne retourné, c'est qu'il n'existe pas d'article si le blog est vierge, ou
	que la recherche d'article n'a rien trouvé.
	*/
	if(mysql_num_rows($res) > 0){
		while($data = mysql_fetch_array($res)){
			$id = $data['id'];
			$cheminDest = "data/images/$id.jpg";
			echo '<h3>'.utf8_encode($data['titre']).'</h3>';
			echo '<h5> Posté le '.$data['date'].'</h5>';
				
			//Affiche l'image si le fichier existe sur le disque.
			if(file_exists($cheminDest)){
				echo "<img src='vignette.jpg.php?id=$id'>";
			}
				
			echo '<p>'.nl2br(htmlspecialchars($data['contenu'])).'</p>';
			
			if($connect == true){
				echo "<a class='btn btn-primary' href='article.php?id=$id'>Modifier</a> ";
				echo "<a class='btn btn-danger' href='supprimer_article.php?id=$id'>Supprimer</a>";
			}
			
			echo '<hr/>';
		}
	}else{
		echo '<div class="alert alert-warning">
				<strong>Aucun article ne correspond à votre recherche.</strong>
				</div>';
	}

	include('includes/footer.inc.php');
	
?>
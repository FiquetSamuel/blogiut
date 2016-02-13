<?php
	include('includes/connexion.inc.php');
	include('includes/header.inc.php');
	include('includes/verif_util.inc.php');
	
	if(!isset($_POST['subRecherche'])){
		
		$res = mysql_query("SELECT * FROM articles ORDER BY `date` DESC;");
		date_default_timezone_set('UTC');

		//Affichage des articles.
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
		$recherche = mysql_real_escape_string(htmlspecialchars($_POST['recherche']));
		$queryRech = mysql_query("SELECT * FROM articles WHERE titre LIKE '%$recherche%' OR contenu LIKE '%$recherche%';");
		if(mysql_num_rows($queryRech) > 0){
			while($display = mysql_fetch_array($queryRech)){
				$id = $display['id'];
				$cheminDest = "data/images/$id.jpg";
				echo '<h3>'.utf8_encode($display['titre']).'</h3>';
				echo '<h5> Posté le '.$display['date'].'</h5>';
				
				//Affiche l'image si le fichier existe sur le disque.
				if(file_exists($cheminDest)){
					echo "<img src='vignette.jpg.php?id=$id'>";
				}
				
				echo '<p>'.nl2br(htmlspecialchars($display['contenu'])).'</p>';
			}
		}
	}
	
	include('includes/footer.inc.php');
	
?>
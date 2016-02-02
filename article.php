<?php
	include('includes/connexion.inc.php');
	include('includes/header.inc.php');
	include('includes/verif_util.inc.php');
	
	//Empêche l'accès à la page article.php sans être connecté.
	if($connect == true){
		if(isset($_POST['titre'])){
			if(isset($_POST['id'])){
				$id = $_POST['id'];
				$titre = mysql_real_escape_string($_POST['titre']);
				$contenu = mysql_real_escape_string($_POST['contenu']);
				$sql = mysql_query("UPDATE articles SET titre='$titre', contenu='$contenu' WHERE id=$id");
				$imgId = $id;
				mysql_query($sql);
				header("Location:index.php");
			}else{
				$titre = mysql_real_escape_string($_POST['titre']);
				$contenu = mysql_real_escape_string($_POST['contenu']);
				date_default_timezone_set('UTC');
				$date = date("Y-m-d");
				$insert = mysql_query("INSERT INTO articles(titre, contenu, date) VALUES('$titre', '$contenu', '$date');");
				
				mysql_query($insert);
				$imgId = mysql_insert_id();
				echo "<div class='alert alert-success'>
						<strong>L'article a été envoyé avec succès.</strong> 
					</div>";
			}
			//On vérifie qu'il y a un fichier
			if($_FILES['image']['error'] == 0){
				$imgMaxSize = 1048576; //1Mo
				//Vérification du type du $_FILES
				if($_FILES['image']['type'] == 'image/jpg' || $_FILES['image']['type'] == 'image/jpeg'){
					//PHP.ini retourne un fichier de taille 0 si l'on dépasse sa limite de taille d'upload.
					if(filesize($_FILES['image']['tmp_name']) < $imgMaxSize && filesize($_FILES['image']['tmp_name']) > 0){
						$imgReq = mysql_query('SELECT MAX(id) FROM articles;');
						$cheminSrc = $_FILES['image']['tmp_name'];
						$cheminDest = dirname(__FILE__).'/data/images/'.$imgId.'.jpg';
						move_uploaded_file($cheminSrc, $cheminDest);
						header("Location:index.php");
					}else{
						echo '<div class="alert alert-warning">
							<strong>Le fichier a upload est trop gros. (1Mo Max)</strong>
						</div>';
					}
				}
				else{
					echo '<div class="alert alert-warning">
							<strong>Le format du fichier est incorrect (JPG/JPEG uniquement)</strong>
						</div>';
				}
			}else{
				header("Location:index.php");
			}
		}else{
			$titre = "";
			$contenu = "";
			if(isset($_GET['id'])){
				$id = (int) $_GET['id'];
				$res = mysql_query("SELECT * FROM articles WHERE id=$id;");
				$data= mysql_fetch_array($res);
				$titre = $data['titre'];
				$contenu = $data['contenu'];
			}
		}
	}else{
		header('Location:index.php');
	}
?>

	<form action="article.php" method="post" enctype="multipart/form-data">
		<?php if(isset($_GET['id'])){ echo "<input type='hidden' name='id' value=$id>";}?>
		<div class="clearfix">
			<label for="titre">Titre:</label>
			<input id="titre" name="titre" size="255" type="text" value="<?php echo $titre;?>">
		</div>
		<div class="clearfix">
			<label for="contenu">Contenu:</label>
			<textarea id="contenu" name="contenu" cols="60" rows="20"><?php echo $contenu;?></textarea>
			</div>
			<label for="image">Image:</label>
			<input type="file" name="image">
		<input class="btn btn-primary" id="envoi" type="submit" value="Enregistrer">
	</form>
		

<?php
	include('includes/footer.inc.php');
?>
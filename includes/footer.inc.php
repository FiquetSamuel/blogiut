</div>
	
				<nav class="span4">
					<h2>Menu</h2>
					<ul>
						<li><a href="index.php">Accueil</a></li>
						<?php
							//Affiche différent menu si l'on s'est connecté ou non.
							if($connect == true){
								echo '<li><a href="article.php">Rédiger un article</a></li>
									  <li><a href="deconnexion.php">Déconnexion</a></li>';
							}else{
								echo '<li><a href="connexion.php">Connexion</a></li>';
								echo '<li><a href="inscription.php">Inscription</a></li>';
							}
							//On affiche la barre de recherche uniquement si la page est index.php
							if(basename($_SERVER['PHP_SELF']) == 'index.php' ){
								echo '<li><form method="post" action="#">
									<input type="text" name="recherche" placeholder="Rechercher un article">
									<input class="btn btn-primary" type="submit" name="subRecherche" value="Rechercher">
									</form>
								</li>';
							}
						?>
					</ul>
					
				</nav>
        </div>
        
      </div>

      <footer>
        <p>&copy; Samuel FIQUET 2015</p>
      </footer>
	<script>
		$('ul').css('display', 'none');
		$('.span4').hover(function(){
			$('ul').slideDown();
		},function(){
			$('ul').slideUp();
		});
	</script>
    </div>

  </body>
</html>

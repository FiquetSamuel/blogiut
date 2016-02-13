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
						?>
					</ul>
					
				</nav>
        </div>
        
      </div>

      <footer>
        <p>&copy; Samuel FIQUET 2015</p>
      </footer>

    </div>

  </body>
</html>

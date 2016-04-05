</div>
	
				<nav class="span4">
					<h2>Menu</h2>
					<ul id="myUl">
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
								echo '<li><input type="email" id="email" name="newsletter" placeholder="Abonnez vous!">
										<input class="btn btn-primary" type="button" name="subNews" value="Abonnez" onclick="myFunction()">
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
    </div>

  </body>
  	<script>
		$('#myUl').css('display', 'none');
		$('.span4').hover(function(){
			$('#myUl').slideDown();
		},function(){
			$('#myUl').slideUp();
		});
	
	$('#email').keypress(function(event){
		var entrer = (event.keyCode ? event.keyCode : event.which);
		if(entrer == '13'){
			myFunction();
		}
	});
	
	function myFunction() {
			var email = $('#email').val();
			if (email == '') {
				alert('Remplir champs');
			} else {
				var dataEmail = '?email=' + email;
				// AJAX code to submit form.
				$.ajax({
					type: 'GET',
					url: 'newsletter.php'+dataEmail,
					data: dataEmail,
					cache: false,
					success: function(data) {
						$('ul').append(data);
						$('#email').val('');
					}
				});
			}
		return false;
	}
	
	
	function like() {
			$('input[id^="tag"]').on('click', function() {  
			
			//var split = this.value.split(' ');
			var split = this.id.split(' ');
			var id = split[1];
			//alert(id);
			//var nbLike = split[1];
			var dataId = '?id=' + id;
				// AJAX code to submit form.
				$.ajax({
					type: 'GET',
					url: 'like.php'+dataId,
					data: dataId,
					cache: false,
					success: function(data) {
					$('input[id^="tag"]').attr('value', 'J\'aime '+data);
					alert(data);
						
					}
				});
			//alert(id);
		});
		return false;
	}
	
	function removeParent(){
		$('.close').parent().remove();
		return false;
	}
	
	jQuery(document).ready(function($) {
	$('#my-slideshow').bjqs({
		'height' : 320,
		'width' : 620,
		'responsive' : true,
		'showmarkers': false
	});
});
	</script>
</html>

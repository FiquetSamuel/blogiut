# blog
 
Inscription disponible ici: https://github.com/FiquetSamuel/blogiut/blob/master/inscription.php

La page contient un formulaire d'inscription, ce formulaire a un champ Nom, un champ Prénom,
un champ e-mail, un champ mot de passe et un champ confirmation mot de passe.

Au niveau du PHP, je vérifie d'abord que la variable $connect provenant de verif_util.inc.php est égale à true.
Si elle l'est, alors je redirige vers l'index.php, étant donné qu'il n'y a aucun intérêt à se créer un compte si l'on est
déjà connecté. Sinon, dans le else, on commence les différente vérifications. 

Tout d'abord si le $_POST du submit est lancé ou non. Si il l'est, on prépare les variables et on vérifie ensuite si tout les champs sont remplis. Si il ne le sont pas, on retourne un message d'erreur. Sinon, on passe à la vérification suivante, l'adresse email.

Si le filtre_var de PHP retourne une erreur avec le filtre VALIDATE_EMAIL, alors on retourne un message d'erreur. Sinon, on vérifie que l'adresse email envoyé n'existe pas déjà dans la base de données. Si elle existe déjà, on renvoi un message d'erreur, et l'on évite d'avoir plusieurs fois la même email dans la base de données, ce qui est le mieux à faire si l'on doit ajouter plus tard la fonctionnalité de recevoir un mot de passe par mail si on oublie son mot de passe. Si l'email est valide, on passe à la vérification des mots de passe.

On vérifie que les variables POST des mdp et vérification mdp sont identique. Si ils ne sont pas identique, on renvoit une erreur. Sinon, on peut finaliser l'inscription avec l'ajout dans la base de données. On effectue une requête SQL pour rechercher la personne qu'on vient d'ajouter. Si il y a un résultat, on affiche que le compte est créé.

Moteur basique disponible ici: https://github.com/FiquetSamuel/blogiut/blob/master/moteurbasique.php

/!\ Le moteur basique n'est pas disponible sur le site. Il n'est présent que sur GitHub pour la correction du TP Blog./!\

La barre de recherche n'est disponible que sur l'index.php (moteurbasique.php étant index.php mais avec la première version du moteur.)

Tout d'abord, je vérifie que le submit du moteur de recherche n'est pas lancé. Si il ne l'est pas, je déclare une variable res qui va faire une recherche de tout les articles dans la BDD trié par date décroissante. Sinon, je défini deux variables, une variable $recherche qui contient ce qui est passé dans le moteur. La deuxième variable, $res contient la requête SQL des articles ayant pour mot clé $recherche.

Une fois cette première vérification faite, on en fait une autre: si le nombre de ligne retourné par mysql est supérieur à 0 alors on effectue l'affichage des articles en utilisant mysql_fetch_array sur la variable $res que l'on a défini dans le précédent if/else. Si il n'y a pas de ligne retournée, alors la recherche dans le moteur ne retourne rien.

Moteur de recherche avancé disponible ici: https://github.com/FiquetSamuel/blogiut/blob/master/index.php

On réutilise la même forme que pour le moteur basique, sauf que cette fois ci, on modifie le else du premier if/else. 
Dans ce else, on explode la variable $recherche sur les espaces dnas une variable intermediaire $rechExp. On prépare ensuite la recherche SQL mais de manière incomplète, on se stoppe sur le WHERE. 

Enfin, on effectue une boucle allant de 0 jusqu'à la fin du tableau des mots clés recherchés ($size) -1. Dans cette boucle on construit le reste de la requête. Si $i est égale à $size - 1 alors cela signifie que l'on arrive à la fin de la boucle, et on concatène la fin de la requête SQL ($req) dans cette même variable ($req). Sinon, on concatène la recherche des différent mot clé dans la variable $req.  


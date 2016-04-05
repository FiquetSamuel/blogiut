<?php
/*
inc connexion bdd
recup email
req sql
retour 'ok', 'deja abo', 'ko'

créé form.ds menu champ+bouton
*/
	include('includes/connexion.inc.php');
	include('includes/verif_util.inc.php');

	$id = mysql_real_escape_string($_GET['id']);
	$ip = "192.168.0.1";
	if(!empty($id) && $id != ''){
		$select = mysql_query("SELECT ip, idarticles FROM vote WHERE idarticles=$id AND ip='$ip';");
		if(mysql_num_rows($select) > 0){
			echo 'Echec';
		}else{
			mysql_query("INSERT INTO vote(ip, idarticles) VALUES('$ip',$id);");
			mysql_query("UPDATE articles SET `like`=`like`+1 WHERE id = $id;");
			$selectLike = mysql_query("SELECT `like` FROM articles WHERE id = $id;");
			//echo "SELECT like FROM articles WHERE id = $id;";
			//echo "INSERT INTO vote(ip, idarticles) VALUES('$ip',$id);UPDATE articles SET like=like+1 WHERE id = $id;";
			$result = mysql_fetch_row($selectLike);
			echo $result[0];
			
		}
	}
?>
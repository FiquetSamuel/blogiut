<?php

include('includes/connexion.inc.php');
header("Content-type: image/jpg");

//Calcul ratio et taille voulue.
$id = $_GET['id'];
$cheminImg = "data/images/$id.jpg";
list($orgLarg, $orgHaut) = getimagesize($cheminImg);

$largVoulue = 200;
$ratio = $orgLarg/$largVoulue;

$newLarg = (int) $orgLarg/$ratio;
$newHaut = (int) $orgHaut/$ratio;

//Création image
$imgCreat = imagecreatetruecolor($newLarg, $newHaut);
$myImg = imagecreatefromjpeg($cheminImg);
imagecopyresampled($imgCreat, $myImg, 0, 0, 0, 0, $newLarg, floor($newHaut), $orgLarg, $orgHaut);

//Affichage
imagejpeg($imgCreat, null, 100);

?>
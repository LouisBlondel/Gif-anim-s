<?php
/*
Fichier : test.php


*/
$longueur = 200;
$hauteur = 100;
$couleur1 = 255;
$couleur2 = 100;
$couleur3 = 50;
$i;

//créer 3 frames
for ($i = 1; $i <= 3; $i++){
	$image = imagecreate($longueur, $hauteur);
	$fond = imagecolorallocate($image, $couleur1, $couleur2, $couleur3);
	if ($i == 1){
		$rectangle = imagecolorallocate($image, 255, 0, 0);
	}
	if ($i == 2){
		$rectangle = imagecolorallocate($image, 0, 255, 0);
	}
	if ($i == 3){
		$rectangle = imagecolorallocate($image, 0, 0, 255);
	}
	imagefilledrectangle($image, 50, 30, 100, 60, $rectangle);
	$chemin_fichier = "frames/frame".$i.".gif";
	imagegif($image,$chemin_fichier);
	imagedestroy($image);
}

//appeler makegif
$commande = "./makegif -d 100 gifs/animationtest.gif frames/frame1.gif frames/frame2.gif frames/frame3.gif";
exec($commande, $sortie, $codeRetour);

//afficher
if ($codeRetour == 0){
	echo "<img src=\"gifs/animationtest.gif\"/>";
}
else{
	echo "<div>Erreur makegif, code : $codeRetour</div>";
	echo "<br />";
	foreach ($sortie as $sortie2){
		echo $sortie2;
		echo "<br />";
	}
}

//supprimer les frames dans le dossier frames
for ($i = 1; $i <= 3; $i++){
	$fichier_supprimer = "frames/frame".$i.".gif";
	if (file_exists($fichier_supprimer)){
		unlink($fichier_supprimer);
	}
}
?>

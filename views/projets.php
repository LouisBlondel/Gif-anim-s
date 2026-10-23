<?php

// fichier projets.php

// empêche l'accès direct au fichier sans passer par index.php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=accueil");
	die("");
}

echo "<h1>Les projets</h1>";

// pour le nombre de projets
$aucun = true;

foreach (listerProjets(utilisateurCourant()) as $p)
{
	// on affiche à quoi ressemble le gif si il existe encore
	$id = $p['id'];
	
	$aucun = false;
	
	if (file_exists("gifs/" . $id. ".gif"))  // au cas où on a supprimé le gif 
	{
		echo "<img src=\"gifs/$id.gif\" height=\"50\"/>";
	}
	
	echo "<p>" . htmlspecialchars($p['nom']) . "</p>";
	echo "<a href=\"index.php?view=Gif&id=".$id ."\">Voir</a>";
	echo "<br />";
	echo "<a href=\"index.php?view=Formulaire&projet=" . $id."\">Reprendre</a>";
	echo "<br />";
	echo "<br />";
}

if ($aucun)
{
	echo "<p>Aucun projet pour le moment.</p>";
}
?>
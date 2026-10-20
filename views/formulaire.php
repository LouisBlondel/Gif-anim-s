<?php

/*
Fichier : formulaire.php
*/

// empêche l'accès direct au fichier sans passer par index.php

if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=accueil");
	die("");
}


if ($msg = valider ("msg"))
{
	echo "<p>$msg</p>";
}
/*
// on regarde si on recoit un gif 
if ($gif = valider("gif"))
{
	echo "<p><img src=\"gifs/$gif\" alt=\"GIF animé\"/></p>";
}
*/

$logos = listerLogos();


// projet à reprendre : false si on crée un nouveau GIF, ou si le projet n'appartient pas à l'utilisateur
$projet = valider("projet");
$projet_repris = chargerProjet($projet, utilisateurCourant());
$nom_p = parametre($projet_repris, "nom", "");
$texte_p = parametre($projet_repris, "texte", "");
$fond_p = parametre($projet_repris, "fond", "");
$logo_p = parametre($projet_repris, "logo", "");
$police_p = parametre($projet_repris, "police", "");
$couleur_p = parametre($projet_repris, "couleur", "blanc");
$position_texte_p = parametre($projet_repris, "position_texte", "centre");
$position_logo_p = parametre($projet_repris, "position_logo", "bas-droite");

$polices = listerPolices();
?>

<h1>Création de GIF animé</h1>

<!-- d'après la diapo n°34 du cours RIA S1 Multimédia, il est nécessaire de mettre : enctype="multipart/form-data" pour specifier la presence d'un fichier et aussi, il est necessaire de specifier la taille maximale du fichier-->
<form enctype="multipart/form-data" action="controleur.php" method="post">
	<?php

		echo "<input type=\"hidden\" name=\"projet\" value=\"" . htmlspecialchars($projet) . "\" />";

	?>
	<input type="hidden" name="MAX_FILE_SIZE" value="10000000">

	<fieldset>
		<legend>Image de fond</legend>
		<label for="image_fond">Choisir une image de fond :</label>
		<br />
		<input type="file" name="image_fond" id="image_fond"/>
		<?php
			if ($fond_p != "" && file_exists("uploads/" . $fond_p))
			{
				echo "<img src=\"uploads/$fond_p\"height=\"60\"alt=\"Image\" /> Image actuelle";
			}
		?>
	</fieldset>
	
	<br />
	
	<fieldset>
		<legend>Texte de l'animation</legend>
		<label for="texte_gif">Saisir un texte :</label>
		<br />
		<?php
			echo "<input type=\"text\" name=\"texte_gif\" value=\"" . htmlspecialchars($texte_p) . "\" />";
		?>
	</fieldset>
	
	<fieldset>
		<legend>Logo</legend>
		<?php	
			foreach ($logos as $next)
			{
				$actuel = "";
				if ($next == $logo_p)
				{
					$actuel = "checked";
				}
				echo "<label>";
				echo "<input type=\"radio\" name=\"logo\" value=\"$next\" $actuel>";
				echo "<img src=\"logos/$next\" height=\"40\"alt=\"$next\"/>";
				echo "</label> ";
				echo "<br />";
			}
		?>
		<label for="nouveau_logo">Nouveau logo :</label>
		<br />
		<input type="file" name="nouveau_logo" id="nouveau_logo"/>
	</fieldset>
	
	<br />
	
	<fieldset>
		<legend>Personnalisation</legend>
		<label for="position_logo">Position du logo :</label>
		<select name="position_logo" id="position_logo">
			<option value="haut-gauche"
			<?php 
				if ($position_logo_p == "haut-gauche")
				{ 
					echo "selected"; 
				} 
			?>
			>Haut gauche</option>
			<option value="haut-droite" 
			<?php 
				if ($position_logo_p =="haut-droite")
				{
					echo "selected"; 
				} 
			?>
			>Haut droite</option>
			<option value="bas-gauche" 
			<?php 
				if ($position_logo_p == "bas-gauche") 
				{ 
					echo "selected"; 
				} 
			?>
			>Bas gauche</option>
			<option value="bas-droite"
			<?php 
				if ($position_logo_p=="bas-droite") 
				{ 
					echo "selected"; 
				} 
			?>
			>Bas droite (par défaut)</option>
		</select>
		
		<br />
		<label for="position_texte">Position du texte :</label>
		<select name="position_texte" id="position_texte">
			<option value="centre"
			<?php 
				if ($position_texte_p == "centre")
				{ 
					echo "selected"; 
				} 
			?>
			>Centre (par défaut)</option>
			<option value="haut" 
			<?php 
				if ($position_texte_p =="haut")
				{
					echo "selected"; 
				} 
			?>
			>Haut</option>
			<option value="bas" 
			<?php 
				if ($position_texte_p == "bas") 
				{ 
					echo "selected"; 
				} 
			?>
			>Bas</option>
			<option value="gauche"
			<?php 
				if ($position_texte_p=="gauche") 
				{ 
					echo "selected"; 
				} 
			?>
			>Gauche</option>
			<option value="droite"
			<?php 
				if ($position_texte_p=="droite") 
				{ 
					echo "selected"; 
				} 
			?>
			>droite</option>
		</select>
		
		<br />
		
		<label for="police">Police du texte :</label>
		<select name="police" id="police">
        <?php
        	
        	foreach (listerPolices() as $nom_police)
			{
				$select = "";
				if ($nom_police == $police_p)
				{
					$select = "selected";
				}
				// on affiche chaque police disponible
				echo "<option value=\"$nom_police\" $select>$nom_police</option>";
			}
        ?>
		</select>
		
		<br />
		
		<label for="couleur">Couleur du texte :</label>
		<select name="couleur" id="couleur">
			<option value="blanc"
			<?php 
				if ($couleur_p == "blanc")
				{ 
					echo "selected"; 
				} 
			?>
			>Blanc (par défaut)</option>
			<option value="noir" 
			<?php 
				if ($couleur_p =="noir")
				{
					echo "selected"; 
				} 
			?>
			>Noir</option>
			<option value="jaune"
			<?php 
				if ($couleur_p=="jaune") 
				{ 
					echo "selected"; 
				} 
			?>
			>Jaune</option>
			<option value="rouge"
			<?php 
				if ($couleur_p=="rouge") 
				{ 
					echo "selected"; 
				} 
			?>
			>Rouge</option>
		</select>

	</fieldset>
	<fieldset>
		<legend>Projet</legend>
			<label for="nom_projet">Nom du projet :</label>
			<?php
				echo "<input type=\"text\" name=\"nom_projet\" value=\"" . htmlspecialchars($nom_p) . "\"/>";
				 
			?>
	</fieldset>

	<br />
	<br />
	
	<input type="submit" name="action" value="Générer">

</form>

		

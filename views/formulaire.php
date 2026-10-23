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

$logos = listerLogos();

// liste variables pour le formulaire
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
$largeur_p = parametre($projet_repris, "largeur", 0);
$hauteur_p = parametre($projet_repris, "hauteur", 0);
$nb_frames_p = parametre($projet_repris, "nb_frames", 3);
$duree_p = parametre($projet_repris, "duree", 100);
$apparition_p = parametre($projet_repris, "apparition", "coup");
$defilement_p = parametre($projet_repris, "defilement", "aucun");

// tableaux pour les select
$tabPosLogo = array(
    array("val" => "haut-gauche", "label" => "Haut gauche"),
    array("val" => "haut-droite", "label" => "Haut droite"),
    array("val" => "bas-gauche", "label" => "Bas gauche"),
    array("val" => "bas-droite", "label" => "Bas droite (par défaut)")
);

$tabPosTexte = array(
    array("val" => "centre", "label" => "Centre (par défaut)"),
    array("val" => "haut", "label" => "Haut"),
    array("val" => "bas", "label" => "Bas"),
    array("val" => "gauche", "label" => "Gauche"),
    array("val" => "droite", "label" => "Droite")
);

$tabCouleurs = array(
    array("val" => "blanc", "label" => "Blanc (par défaut)"),
    array("val" => "noir", "label" => "Noir"),
    array("val" => "jaune", "label" => "Jaune"),
    array("val" => "rouge", "label" => "Rouge")
);

$tabApparition = array(
    array("val" => "coup", "label" => "D'un coup (par défaut)"),
    array("val" => "fondu", "label" => "Fondu (Fade in)")
);

$tabDefilement = array(
    array("val" => "aucun", "label" => "Aucun (Fixe)"),
    array("val" => "gauche-droite", "label" => "De gauche à droite"),
    array("val" => "droite-gauche", "label" => "De droite à gauche"),
    array("val" => "bas-haut", "label" => "De bas en haut"),
    array("val" => "haut-bas", "label" => "De haut en bas")
);


$tabPolices = array();
foreach (listerPolices() as $nom_police) {
    $tabPolices[] = array("val" => $nom_police, "label" => $nom_police);
}
?>

<h1>Création de GIF animé</h1>

<!-- d'après la diapo n°34 du cours RIA S1 Multimédia, il est nécessaire de mettre : enctype="multipart/form-data" pour specifier la presence d'un fichier et aussi, il est necessaire de specifier la taille maximale du fichier-->
<form enctype="multipart/form-data" action="controleur.php" method="post">
	
	<?php
		mkInput("hidden", "projet", htmlspecialchars((string)$projet));
	?>
	<input type="hidden" name="MAX_FILE_SIZE" value="10000000">

	<fieldset>
		<legend>Image de fond</legend>
		<label for="image_fond">Choisir une image de fond :</label>
		<br />
		<?php mkInput("file", "image_fond", "", "id=\"image_fond\""); ?>
		<?php
			if ($fond_p != "" && file_exists("uploads/" . $fond_p))
			{
				echo "<br /><img src=\"uploads/$fond_p\" height=\"60\" alt=\"Image\" /> Image actuelle";
			}
		?>
	</fieldset>
	
	<br />
	
	<fieldset>
		<legend>Texte de l'animation</legend>
		<label for="texte_gif">Saisir un texte :</label>
		<br />
		<?php mkInput("text", "texte_gif", htmlspecialchars($texte_p), "id=\"texte_gif\""); ?>
	</fieldset>
	
	<br />

	<fieldset>
		<legend>Logo</legend>
		<?php	
			foreach ($logos as $next)
			{
				$actuel = ($next == $logo_p); // renvoie true ou false pour pré-cocher le bon bouton
				echo "<label>";
				mkRadioCb("radio", "logo", $next, $actuel);
				echo "<img src=\"logos/$next\" height=\"40\" alt=\"$next\"/>";
				echo "</label> <br />";
			}
		?>
		<label for="nouveau_logo">Nouveau logo :</label>
		<br />
		<?php mkInput("file", "nouveau_logo", "", "id=\"nouveau_logo\""); ?>
	</fieldset>
	
	<br />
	
	<fieldset>
		<legend>Personnalisation</legend>
		<label for="position_logo">Position du logo :</label>
		<?php mkSelect("position_logo\" id=\"position_logo", $tabPosLogo, "val", "label", $position_logo_p); ?>
		<br />
		
		<label for="position_texte">Position du texte :</label>
		<?php mkSelect("position_texte\" id=\"position_texte", $tabPosTexte, "val", "label", $position_texte_p); ?>
		<br />
		
		<label for="police">Police du texte :</label>
		<?php mkSelect("police\" id=\"police", $tabPolices, "val", "label", $police_p); ?>
		<br />
		
		<label for="couleur">Couleur du texte :</label>
		<?php mkSelect("couleur\" id=\"couleur", $tabCouleurs, "val", "label", $couleur_p); ?>
	</fieldset>

	<br />

	
	<fieldset>
		<legend>Animation du texte</legend>
		<label for="apparition">Mode d'apparition :</label>
		<?php mkSelect("apparition\" id=\"apparition", $tabApparition, "val", "label", $apparition_p); ?>
		<br />
		
		<label for="defilement">Sens de défilement :</label>
		<?php mkSelect("defilement\" id=\"defilement", $tabDefilement, "val", "label", $defilement_p); ?>
	</fieldset>

	<br />

	<fieldset>
        <legend>Paramètres de l'animation</legend>
        <label for="largeur">Largeur (0 = taille de l'image de fond) :</label>
        <?php mkInput("number", "largeur", $largeur_p, "id=\"largeur\" min=\"0\""); ?>
        <br />

        <label for="hauteur">Hauteur (0 = taille de l'image de fond) :</label>
        <?php mkInput("number", "hauteur", $hauteur_p, "id=\"hauteur\" min=\"0\""); ?>
        <br />
        
        <label for="nb_frames">Nombre d'images (frames) :</label>
        <?php mkInput("number", "nb_frames", $nb_frames_p, "id=\"nb_frames\" min=\"2\" max=\"50\""); ?>
        <br />

        <label for="duree">Durée d'une frame (ms) :</label>
        <?php mkInput("number", "duree", $duree_p, "id=\"duree\" min=\"10\" step=\"10\""); ?> // step pour des sauts de 10 en 10
    </fieldset>

	<br />

	<fieldset>
		<legend>Projet</legend>
		<label for="nom_projet">Nom du projet :</label>
		<?php mkInput("text", "nom_projet", htmlspecialchars($nom_p), "id=\"nom_projet\""); ?>
	</fieldset>

	<br />
	<br />
	
	<?php mkInput("submit", "action", "Générer"); ?>

</form>
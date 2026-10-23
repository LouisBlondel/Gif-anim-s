<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
	header("Location:../index.php?view=accueil");
	die("");
}
?>

<div>
    <h1>Bienvenue sur le Générateur de GIF Animés</h1>
    
    <p>Cette application interactive, développée dans le cadre du module RIA à l'IG2I, vous permet de créer automatiquement des animations GIF personnalisées.</p>
    
    <h3>Comment ça marche ?</h3>
    <ul>
        <li><strong>1. Choisissez un fond :</strong> Uploadez votre propre image de fond.</li>
        <li><strong>2. Ajoutez votre texte :</strong> Saisissez un message, choisissez sa police, sa couleur et paramétrez son animation (apparition, défilement).</li>
        <li><strong>3. Intégrez un logo :</strong> Sélectionnez un logo existant ou uploadez le vôtre et positionnez-le où vous le souhaitez.</li>
        <li><strong>4. Paramétrez l'animation :</strong> Définissez les dimensions, le nombre de frames et la vitesse de l'animation.</li>
    </ul>

    <br />

    <?php if (!isset($_SESSION['idUser'])) { ?>
        <p><strong>Pour commencer à créer et sauvegarder vos propres projets, veuillez vous connecter ou créer un compte.</strong></p>
    <?php } else { ?>
        <p><strong>Vous êtes connecté. Rendez-vous dans l'onglet "Créer un GIF" pour démarrer !</strong></p>
    <?php } ?>

</div> 
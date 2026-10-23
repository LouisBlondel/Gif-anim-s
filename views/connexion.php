<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
	header("Location:../index.php?view=Accueil");
	die("");
}
?>
<div>
    <h1>Se connecter</h1>

    <?php 
    if ($msg = valider("msg")) { 
        echo "<p><strong>$msg</strong></p>"; 
    } 

    mkForm("controleur.php", "POST");
        mkInput("hidden", "action", "Connexion");
        
        echo "<label>Pseudo : ";
        mkInput("text", "pseudo");
        echo "</label><br><br>\n";
        
        echo "<label>Mot de passe : ";
        mkInput("password", "passe");
        echo "</label><br><br>\n";
        
        mkInput("submit", "bouton_connexion", "Connexion");
    endForm();
    ?>
    
    <br />
    <p>Pas encore de compte ? <?php mkLien("index.php", "S'inscrire ici", "view=Inscription"); ?>.</p>
</div>
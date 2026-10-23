<h1>Générateur de GIF Animés</h1>
<body>
        <h2>GIF Maker - IG2I</h2>
        <div>
            <?php
            mkLien("index.php", "Accueil", "view=Accueil");
            echo " | ";
            mkLien("index.php", "Créer un GIF", "view=Formulaire");
            echo " | ";
            mkLien("index.php", "Voir les projets", "view=Projets");
            echo " | ";

            if (isset($_SESSION['idUser'])) {
                echo '<span>Bonjour ' . htmlspecialchars($_SESSION['pseudo']) . ' !</span> | ';
                mkLien("controleur.php", "Se déconnecter", "action=Deconnexion");
            } else {
                mkLien("index.php", "Connexion", "view=Connexion");
                echo " | ";
                mkLien("index.php", "Inscription", "view=Inscription");
            }
            ?>
        </div>
        <hr>
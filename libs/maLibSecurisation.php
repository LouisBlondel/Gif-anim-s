<?php
/*
Fichier : maLibSecurisation.php
*/

include_once "libs/modele.php";


function utilisateurCourant()
{
	$u = getUtilisateurParPseudo("provisoire");
	if ($u === false)
	{
		// première utilisation : on crée l'utilisateur provisoire
		return creerUtilisateur("provisoire", "inutilisable");
	}
	return $u['id'];
}
?>

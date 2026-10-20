<?php
/*
Fichier : modele.php
Acces à la base de donnees : tables "utilisateur" et "projet"
*/

include_once "libs/config.php";
include_once "libs/maLibSQL.pdo.php";

///////////////////////////////////////////////
// Utilisateurs
///////////////////////////////////////////////

// Renvoie l'utilisateur ayant ce pseudo, ou false
function getUtilisateurParPseudo($pseudo)
{
	$res = SQLSelect("SELECT * 
					FROM utilisateur 
					WHERE pseudo='$pseudo'");
	$tab = parcoursRs($res);
	if (count($tab) == 0)
	{
		return false;
	}
	return $tab[0];
}

// Cree un compte : le mot de passe est hache avant d'être enregistre 
// renvoie l'identifiant du nouvel utilisateur
function creerUtilisateur($pseudo, $mot_de_passe)
{
	$hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);
	return SQLInsert("INSERT INTO utilisateur (pseudo, mot_de_passe)
					VALUES ('$pseudo', '$hash')");
}

//////////////////////////////////////////////////////
// Projets (chaque projet appartient à un utilisateur)
///////////////////////////////////////////////////////

// Enregistre un projet (meme identifiant que le GIF)
function enregistrerProjet($id, $utilisateur_id, $nom, $texte, $fond, $logo, $police, $couleur, $position_texte, $position_logo, $apparition, $defilement, $largeur, $hauteur, $nb_frames, $duree)
{
	return SQLInsert("INSERT INTO projet (id, utilisateur_id, nom, texte, fond, logo, police, couleur, position_texte, position_logo, apparition, defilement, largeur, hauteur, nb_frames, duree)
					VALUES ('$id', '$utilisateur_id', '$nom', '$texte', '$fond', '$logo', '$police', '$couleur', '$position_texte', '$position_logo', '$apparition', '$defilement', '$largeur', '$hauteur', '$nb_frames', '$duree')");
}

// Renvoie le projet $id s'il appartient à cet utilisateur  sinon false
function chargerProjet($id, $utilisateur_id)
{
	$res = SQLSelect("SELECT * FROM projet
					  WHERE id='$id' AND utilisateur_id='$utilisateur_id'");
	$tab = parcoursRs($res);
	if (count($tab) == 0)
	{
		return false;
	}
	return $tab[0];
}

// Renvoie les projets (id et nom) de cet utilisateur, du plus récent au plus ancien
function listerProjets($utilisateur_id)
{
	$res = SQLSelect("SELECT id, nom FROM projet
						WHERE utilisateur_id='$utilisateur_id'
					    ORDER BY date_creation DESC, id DESC");
	return parcoursRs($res);
}

// Renvoie le parametre $cle du projet $projet (le tableau de chargerProjet), ou $defaut
function parametre($projet, $cle, $defaut)
{
	if ($projet === false || !isset($projet[$cle]))
	{
		return $defaut;
	}
	return $projet[$cle];
}
?>

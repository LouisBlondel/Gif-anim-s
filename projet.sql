CREATE TABLE utilisateur (
	id INT NOT NULL AUTO_INCREMENT,
	pseudo VARCHAR(50) NOT NULL,
	mot_de_passe VARCHAR(255) NOT NULL,
	PRIMARY KEY (id),
	UNIQUE KEY (pseudo)
);

CREATE TABLE projet (
	id VARCHAR(20) NOT NULL,
	utilisateur_id INT NOT NULL,
	nom VARCHAR(100) NOT NULL DEFAULT 'Sans titre',
	texte VARCHAR(255) NOT NULL,
	fond VARCHAR(255) NOT NULL,
	logo VARCHAR(255) NOT NULL,
	police VARCHAR(100) NOT NULL,
	couleur VARCHAR(20) NOT NULL DEFAULT 'blanc',
	position_texte VARCHAR(20) NOT NULL DEFAULT 'centre',
	position_logo VARCHAR(20) NOT NULL DEFAULT 'bas-droite',
	apparition VARCHAR(20) NOT NULL DEFAULT 'coup',
	defilement VARCHAR(20) NOT NULL DEFAULT 'aucun',
	largeur INT NOT NULL DEFAULT 0,
	hauteur INT NOT NULL DEFAULT 0,
	nb_frames INT NOT NULL DEFAULT 3,
	duree INT NOT NULL DEFAULT 100,
	date_creation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id)
);

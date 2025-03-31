-- Table des membres
CREATE TABLE MEMBRE(
   id_membre INT AUTO_INCREMENT,
   pseudo VARCHAR(50)  NOT NULL,
   email VARCHAR(120)  NOT NULL,
   mot_de_passe VARCHAR(255)  NOT NULL,
   role VARCHAR(50)  NOT NULL,
   PRIMARY KEY(id_membre),
   UNIQUE(pseudo),
   UNIQUE(email)
);

-- Table des postulations
CREATE TABLE POSTULATION(
   id_postulation INT AUTO_INCREMENT,
   contenu VARCHAR(750)  NOT NULL,
   statut VARCHAR(50)  NOT NULL,
   date_de_soumission TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
   id_membre INT NOT NULL,
   PRIMARY KEY(id_postulation),
   UNIQUE(id_membre),
   FOREIGN KEY(id_membre) REFERENCES MEMBRE(id_membre) ON DELETE CASCADE
);

-- Table des commentaires
CREATE TABLE COMMENTAIRE(
   id_commentaire INT AUTO_INCREMENT,
   contenu VARCHAR(250)  NOT NULL,
   date_commentaire TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
   id_postulation INT NOT NULL,
   id_membre INT NOT NULL,
   PRIMARY KEY(id_commentaire),
   FOREIGN KEY(id_postulation) REFERENCES POSTULATION(id_postulation) ON DELETE CASCADE,
   FOREIGN KEY(id_membre) REFERENCES MEMBRE(id_membre) ON DELETE CASCADE
);

-- Table des votes
CREATE TABLE VOTE(
   id_vote INT AUTO_INCREMENT,
   choix BOOLEAN,
   date_de_vote TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
   id_postulation INT NOT NULL,
   id_membre INT NOT NULL,
   PRIMARY KEY(id_vote),
   UNIQUE(id_membre, id_postulation),
   FOREIGN KEY(id_postulation) REFERENCES POSTULATION(id_postulation) ON DELETE CASCADE,
   FOREIGN KEY(id_membre) REFERENCES MEMBRE(id_membre) ON DELETE CASCADE
);

-- Table des personnages
CREATE TABLE PERSONNAGE(
   pseudo_personnage VARCHAR(50) ,
   royaume VARCHAR(50)  NOT NULL,
   id_membre INT NOT NULL,
   PRIMARY KEY(pseudo_personnage),
   UNIQUE(pseudo_personnage, id_membre),
   FOREIGN KEY(id_membre) REFERENCES MEMBRE(id_membre) ON DELETE CASCADE
);

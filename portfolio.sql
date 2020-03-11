-- Créer la base de donnée 
CREATE DATABASE IF NOT EXISTS portfolio ;

-- créer la table utlisateur
create table Utilisateurs (
	pseudo varchar(255) not null,
	mail varchar(255) null,
	mdp varchar(255) null
);

-- créer la table commentaires
create table Commentaires (
	idCommentaires int not null auto_increment,
	textCom text null,
	visible int null default '0',
	realisation_IdRealisations int not null,
	utilisateur_pseudo varchar(255) not null,
	primary key (idCommentaires)
);

-- créer la table réalisations
create table Realisations (
	idRealisations int not null auto_increment,
	textReal text null,
	visible int null default '0',
	image varchar(255) null,
	categorie enum('video','design','comm','photo','son','web') null,
	lien varchar(255) null,
	primary key (idRealisations)
);

-- remplit la table utilisateurs
insert into `utilisateurs` values ('henry','thierryhenry@gmail.com','1234'),
('messi','lionelmessi@hotmail.com','3214'),
('suarez','luissuarez@yahoo.com','2341');

-- remplit la table commentaires
insert into `commentaires`(`idCommentaires`, `textCom`, `realisation_IdRealisations`, `utilisateur_pseudo`) values (null, 'blablablabla', '1', 'henry'),
(null, 'il faut marquer des buts', '2', 'suarez'),
(null, 'faire un drible? trop facile', '3', 'messi'),
(null, 'marquer des buts? encore trivial pour moi', '1', 'messi');

-- remplit la table réalisations
insert into `Realisations`(`idRealisations`, `textReal`, `image`, `categorie`, `lien`) values (null, 'explication pour l\'image 1', 'images/im1.png', 'design', null),
(null, 'image 2 schéma bateau', 'images/im2.png', 'design', null),
(null, 'image 3 illustre un travail de communication en cours', 'images/im3.png', 'comm', null),
(null, 'un site web', 'images/im4.png', 'web', null);
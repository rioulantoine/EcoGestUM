USE EcoGestUM;

-- 1) ROLE
INSERT INTO ROLES (nom_role) VALUES
('Présidence'),
('Chef de département'),
('Enseignant'),
('Chef de Composante');

-- 2) STATUT_DEMANDE_OBJET
INSERT INTO STATUT_DEMANDE_OBJET (nom_statut_demande_obj) VALUES
('En attente de réponse'),
('Répondue');

-- 3) STATUT_FORMULAIRE_DONNATION
INSERT INTO STATUT_FORMULAIRE_DONNATION (nom_statut_form_don) VALUES
('En attente'),
('Refusée'),
('Validée');

-- 4) STATUT_OBJET_RECYCLABLE
INSERT INTO STATUT_OBJET_RECYCLABLE (nom_statut_recyclage_objet) VALUES
('disponible'),
('réservé'),
('en réutilisation');

-- 5) CATEGORIE_OBJET
INSERT INTO CATEGORIE_OBJET (nom_cat_obj) VALUES
('Mobiliers'),
('Informatique'),
('Outils'),
('Livres et fournitures');

-- 6) ETAT_OBJET
INSERT INTO ETAT_OBJET (nom_etat_obj) VALUES
('Mauvais état'),
('État moyen'),
('Bon état'),
('Très bon état'),
('Neuf');

-- 7) STATUT_RESERVATION
INSERT INTO STATUT_RESERVATION (nom_statut_res) VALUES
('Prête'),
('En préparation');

-- 8) STATUT_NOTIFICATION
INSERT INTO STATUT_NOTIFICATION (nom_statut_notif) VALUES
('non lu'),
('lu'),
('supprimé');

-- 9) STATUT_OBJECTIF
INSERT INTO STATUT_OBJECTIF (nom_statut_objectif) VALUES
('en cours'),
('atteint'),
('abandonné');

-- 10) TYPE_NOTIF
INSERT INTO TYPE_NOTIF (nom_type_notif) VALUES
('information'),
('alerte'),
('rappel'),
('confirmation');

-- 11) PERIODE
INSERT INTO PERIODE (nom_periode) VALUES
('mensuel'),
('trimestriel'),
('annuel');

-- 12) INVENTAIRE
INSERT INTO INVENTAIRE (nom_inv) VALUES
('Inventaire Dept Informatique'),
('Inventaire Dept Technique de Commercialisation'),
('Inventaire Dept Genie Biologique'),
('Inventaire Dept Metiers du Multimedia et de l Informatique'),
('Inventaire Dept Droit Privée'),
('Inventaire Dept Chimie'),
('Inventaire Dept Gestion des Entreprises et des Administrations'),
('Inventaire Dept Mesures Physiques'),
('Inventaire Dept Droit Privée'),
('Inventaire Dept Genie Mecanique et Productique'),
('Inventaire de l\'université');


-- 13) UNIVERSITE
INSERT INTO UNIVERSITE (nom_univ, adr_univ, id_inv) VALUES
('Le Mans Universite', 'Avenue Olivier Messiaen, 72085 Le Mans Cedex 9', 11);

-- 14) COMPOSANTE
INSERT INTO COMPOSANTE (nom_comp, adr_comp, id_univ) VALUES
('IUT de Laval', '52 Rue des Docteurs Calmette et Guérin Laval, Secrétariat fac de droit', 1),
('Faculté de Droit, Sciences économiques et de Gestion', 'Avenue Olivier Messiaen, 72085 Le Mans Cedex 9', 1),
('Faculté de Lettres, Langues et Sciences Humaines', 'Avenue Olivier Messiaen, 72085 Le Mans Cedex 9', 1),
('Faculté des Sciences et Techniques', 'Avenue Olivier Messiaen, 72085 Le Mans Cedex 9', 1),
('IUT le Mans', 'Avenue Olivier Messiaen, 72085 Le Mans Cedex 9', 1),
('École nationale supérieure d’ingénieurs', 'Avenue Olivier Messiaen, 72085 Le Mans Cedex 9', 1);

-- 15) DEPARTEMENT
INSERT INTO DEPARTEMENT (nom_dept, id_comp, id_inv) VALUES
('Département Informatique', 1, 1),
('Département TC', 1, 2),
('Département GB', 1, 3),
('Département MMI', 1, 4),
('Faculté de Droit, Droit Public', 2, 5),
('Departement chimie', 5, 6),
('Département GEA', 5, 7),
('Département Mesures physiques', 5, 8),
('Faculté de Droit, Droit Privée', 2, 9),
('Département GMP', 5, 10);

-- 16) STATISTIQUE
INSERT INTO STATISTIQUE (nom_stats, val_stats, id_dept, id_periode) VALUES
('Objets récupérés', 120.0, 1, 1),
('Réservations', 25.0, 2, 2),
('Donations', 300.0, 3, 3),
('Taux réutilisation', 40.5, 4, 1),
('Objets réparés', 15.0, 5, 2),
('Événements organisés', 6.0, 3, 3),
('Billets vendus', 75.0, 7, 1),
('Signalements', 9.0, 8, 2),
('Formulaires validés', 22.0, 9, 1),
('Inventaire actualisé', 10.0, 10, 3);

-- 17) OPERATION_RECYCLAGE
INSERT INTO OPERATION_RECYCLAGE (nom_op_recycl, date_op_recycl, id_dept) VALUES
('Opération rentrée', '2025-01-15', 1),
('Tri matériel', '2025-02-10', 2),
('Réparation collective', '2025-03-05', 3),
('Collecte livres', '2025-04-01', 5),
('Atelier menuiserie', '2025-05-06', 6),
('Récupérations objets labo', '2025-06-22', 9),
('Reconditionnement PC', '2025-07-13', 1),
('Tri textile', '2025-08-19', 7),
('Recyclage électronique', '2025-09-30', 8),
('Campagne don', '2025-10-20', 4);

-- 18) PHOTO
INSERT INTO PHOTO (lien_photo) VALUES 
('https://i.pinimg.com/736x/88/68/86/886886dc9332e387b68cdf4d41a0869a.jpg'),
('https://www.tiptoe.fr/wp-content/uploads/2023/07/bureau-mural-wave-chene-noir.jpg'),
('https://img.leboncoin.fr/api/v1/lbcpb1/images/12/21/4f/12214f5b3f057b30c9feebb02f8132831d5ab2b2.jpg?rule=ad-large'),
('https://img.leboncoin.fr/api/v1/lbcpb1/images/fe/4e/af/fe4eaf26ea8700eed7590624111f51199c65535c.jpg?rule=ad-large'),
('https://img.leboncoin.fr/api/v1/lbcpb1/images/57/93/ef/5793ef222c4f11ced36c40623fd7990424f06109.jpg?rule=classified-1200x800-webp'),
('https://img.leboncoin.fr/api/v1/lbcpb1/images/c4/1d/6f/c41d6fc96d39c9436902cfd54960ef26c5673024.jpg?rule=classified-1200x800-webp'),
('https://img.leboncoin.fr/api/v1/lbcpb1/images/d3/d0/01/d3d001cfec2fddf399794ebae1eff508ce18ca42.jpg?rule=classified-1200x800-webp'),
('https://img.leboncoin.fr/api/v1/lbcpb1/images/be/d8/7f/bed87f2d10cc4ea5bd2d7554adf9767ad6e1af2e.jpg?rule=classified-1200x800-webp'),
('https://img.leboncoin.fr/api/v1/lbcpb1/images/5b/16/47/5b164731914d8d219392b80440ebd920863a9575.jpg?rule=classified-1200x800-webp');


-- 19) EVENEMENT
INSERT INTO EVENEMENT (nom_event, desc_event, date_event, prix_event, id_univ) VALUES
('Forum Recyclage', 'Forum inter-départements sur le recyclage', '2024-03-15', 0.0, 1),
('Atelier Réemploi', 'Atelier pratique pour réparer le matériel', '2024-04-10', 10.0, 1),
('Collecte Solidaire', 'Collecte d objets pour dons', '2024-05-20', 0.0, 1),
('Conférence ODD', 'Journée sur les objectifs de développement durable', '2024-06-11', 0.0, 1),
('Brocante Universitaire', 'Vente dobjets recyclés', '2024-07-03', 0.0, 1),
('Hackathon Vert', 'Hackathon sur solutions écologiques', '2024-09-12', 0.0, 1),
('Journée Donation', 'Campagne de dons aux associations', '2024-10-01', 0.0, 1),
('Salon Matériel', 'Exposition du matériel réutilisable', '2024-11-05', 10.0, 1),
('Atelier Couture', 'Réparation et customisation de vêtements', '2024-12-02', 0.0, 1),
('Nettoyage Campus', 'Opération nettoyage et sensibilisation', '2025-03-22', 0.0, 1);

-- 20) UTILISATEUR
INSERT INTO UTILISATEUR (nom_ut, pren_ut, email_ut, mdp_ut, id_univ, id_comp, id_dept) VALUES
('Dupont', 'Alice', 'alice.dupont@univ-lemans.fr', 'adupo1987', 1, NULL, NULL),
('Poisson', 'Monsieur', 'monsieur.poisson@univ-lemans.fr', 'mpois1980', 1, NULL, NULL),
('Cheffy', 'Composan', 'composan.cheffy@univ-lemans.fr', 'cchef2001', 1, 4, NULL),
('Lefevre', 'Paul', 'paul.lefevre@univ-lemans.fr', 'plefe2018', 1, 1, NULL),
('Martin', 'Claire', 'claire.martin@univ-lemans.fr', 'cmart2017', 1, 2, NULL),
('Dubois', 'Nicolas', 'nicolas.dubois@univ-lemans.fr', 'ndubo2016', 1, 5, NULL),
('Leroux', 'Élodie', 'elodie.leroux@univ-lemans.fr', 'elero2023', 1, 3, NULL),
('Bernard', 'Lucas', 'lucas.bernard@univ-lemans.fr', 'lbern2007', 1, 1, 3),
('Moreau', 'Thomas', 'thomas.moreau@univ-lemans.fr', 'tmore2010', 1, 1, 2),
('Grand', 'Julien', 'julien.grand@univ-lemans.fr', 'jgran2015', 1, 1, 4),
('Roulin', 'Olivier', 'olivier.roulin@univ-lemans.fr', 'oroul2019', 1, 1, 1),
('Leroy', 'Hugo', 'hugo.leroy@univ-lemans.fr', 'hlero2023', 1, 3, 5),
('Fournier', 'Amélie', 'amelie.fournier@univ-lemans.fr', 'afour2022', 1, 5, 6),
('Perrot', 'Antoine', 'antoine.perrot@univ-lemans.fr', 'aperr2020', 1, 5, 7),
('Lambert', 'Céline', 'celine.lambert@univ-lemans.fr', 'clamb2019', 1, 5, 8),
('Renard', 'Florent', 'florent.renard@univ-lemans.fr', 'freno2018', 1, 5, 10),
('Girard', 'Maxime', 'maxime.girard@univ-lemans.fr', 'mgira2021', 1, 5, 9),
('Durand', 'Sophie', 'sophie.durand@univ-lemans.fr', 'sdura2021', 1, 3, 3),
('Petit', 'Camille', 'camille.petit@univ-lemans.fr', 'cpeti2022', 1, 1, 2),
('Landry', 'Aurore', 'aurore.landry@univ-lemans.fr', 'aland2020', 1, 1, 4),
('Marcel', 'Guillaume', 'guillaume.marcel@univ-lemans.fr', 'gmarc2020', 1, 1, 1),
('Lemoine', 'Juliette', 'juliette.lemoine@univ-lemans.fr', 'jlemo2024', 1, 3, 5),
('Rousseau', 'Baptiste', 'baptiste.rousseau@univ-lemans.fr', 'brous2023', 1, 5, 6),
('Blanchard', 'Léa', 'lea.blanchard@univ-lemans.fr', 'lblan2022', 1, 5, 7),
('Dufour', 'Maxime', 'maxime.dufour@univ-lemans.fr', 'mdufo2021', 1, 5, 8),
('Caron', 'Émilie', 'emilie.caron@univ-lemans.fr', 'ecaro2020', 1, 5, 9),
('Leclerc', 'Théo', 'theo.leclerc@univ-lemans.fr', 'tlecl2019', 1, 5, 10);


-- 21) ROLE_UTILISATEUR
INSERT INTO ROLE_UTILISATEUR (id_role, id_ut) VALUES
(1,1),(1,2),(4,3),(4,4),(4,5),(4,6),(4,7),
(2,8),(2,9),(2,10),(2,11),(2,12),(2,13),(2,14),(2,15),(2,16),(2,17),
(3,18),(3,19),(3,20),(3,21),(3,22),(3,23),(3,24),(3,25),(3,26),(3,27);

-- 22) BOITE_DE_RECEPTION
INSERT INTO BOITE_DE_RECEPTION (id_ut) VALUES
(1),(2),(3),(4),(5),(6),(7),(8),(9),(10),
(11),(12),(13),(14),(15),(16),(17),
(18),(19),(20),(21),(22),(23),(24),(25),(26),(27);

-- 23) CONVERSATION
-- Conv1: id_conv=1 (1↔2)     Alice ↔ Poisson
INSERT INTO CONVERSATION (id_bdr) VALUES (1);         -- id_conv=1
INSERT INTO CONVERSATION (id_conv, id_bdr) VALUES (1, 2);

-- Conv2: id_conv=2 (3↔4)     Cheffy ↔ Lefevre
INSERT INTO CONVERSATION (id_bdr) VALUES (3);         -- id_conv=2
INSERT INTO CONVERSATION (id_conv, id_bdr) VALUES (2, 4);

-- Conv3: id_conv=3 (5↔6)     Martin ↔ Dubois
INSERT INTO CONVERSATION (id_bdr) VALUES (5);         -- id_conv=3
INSERT INTO CONVERSATION (id_conv, id_bdr) VALUES (3, 6);

-- Conv4: id_conv=4 (7↔8)     Leroux ↔ Bernard
INSERT INTO CONVERSATION (id_bdr) VALUES (7);         -- id_conv=4
INSERT INTO CONVERSATION (id_conv, id_bdr) VALUES (4, 8);

-- Conv5: id_conv=5 (9↔10)    Moreau ↔ Grand
INSERT INTO CONVERSATION (id_bdr) VALUES (9);
INSERT INTO CONVERSATION (id_conv, id_bdr) VALUES (5, 10);

-- Conv6: id_conv=6 (11↔12)   Roulin ↔ Leroy
INSERT INTO CONVERSATION (id_bdr) VALUES (11);
INSERT INTO CONVERSATION (id_conv, id_bdr) VALUES (6, 12);

-- Conv7: id_conv=7 (13↔14)
INSERT INTO CONVERSATION (id_bdr) VALUES (13);
INSERT INTO CONVERSATION (id_conv, id_bdr) VALUES (7, 14);

-- Conv8: id_conv=8 (15↔16)
INSERT INTO CONVERSATION (id_bdr) VALUES (15);
INSERT INTO CONVERSATION (id_conv, id_bdr) VALUES (8, 16);

-- Conv9: id_conv=9 (17↔18)
INSERT INTO CONVERSATION (id_bdr) VALUES (17);
INSERT INTO CONVERSATION (id_conv, id_bdr) VALUES (9, 18);

-- Conv10: id_conv=10 (19↔20)
INSERT INTO CONVERSATION (id_bdr) VALUES (19);
INSERT INTO CONVERSATION (id_conv, id_bdr) VALUES (10, 20);

-- Conv11: id_conv=11 (21↔22)
INSERT INTO CONVERSATION (id_bdr) VALUES (21);
INSERT INTO CONVERSATION (id_conv, id_bdr) VALUES (11, 22);

-- Conv12: id_conv=12 (23↔24)
INSERT INTO CONVERSATION (id_bdr) VALUES (23);
INSERT INTO CONVERSATION (id_conv, id_bdr) VALUES (12, 24);

-- Conv13: id_conv=13 (25↔26)
INSERT INTO CONVERSATION (id_bdr) VALUES (25);
INSERT INTO CONVERSATION (id_conv, id_bdr) VALUES (13, 26);

-- Conv14: id_conv=14 (27↔1)  (boucle possible / ajouter si tu veux des discussions "tournantes")
INSERT INTO CONVERSATION (id_bdr) VALUES (27);
INSERT INTO CONVERSATION (id_conv, id_bdr) VALUES (14, 1);


-- 24) MESSAGE
INSERT INTO MESSAGE (contenu_mess, date_envoi_mess, id_ut, id_ut_1, id_conv) VALUES
('Bonjour, je souhaite réserver cet objet', '2025-02-01 09:10:00', 1, 2, 1),
('Dossier reçu, merci', '2025-02-02 10:15:00', 3, 4, 2),
('Pouvez-vous confirmer la disponibilité ?', '2025-02-03 11:20:00', 5, 6, 3),
('La réservation est confirmée', '2025-02-04 12:25:00', 7, 8, 4),
('Où est l’inventaire ?', '2025-02-05 13:30:00', 9, 10, 5),
('Nous organisons un atelier', '2025-02-06 14:35:00', 11, 12, 6),
('Merci pour la communication', '2025-02-07 15:40:00', 13, 14, 7),
('Eh, terrible la qualité des objets récupérés', '2025-02-08 16:45:00', 15, 16, 8),
('Billet réservé pour être avec toi', '2025-02-09 17:50:00', 17, 18, 9),
('Objet prêt à être récupéré', '2025-02-10 18:55:00', 19, 20, 10),
('Merci d\'avoir répondu à ma demande', '2025-02-11 09:00:00', 21, 22, 11),
('Ok pour la réunion demain', '2025-02-12 10:15:00', 23, 24, 12),
('Peux-tu m\'envoyer la fiche technique ?', '2025-02-13 11:20:00', 25, 26, 13),
('On se retrouve devant l\'amphi ?', '2025-02-14 12:25:00', 27, 1, 14);

-- 25) OBJET_RECYCLABLE
INSERT INTO OBJET_RECYCLABLE 
(nom_obj_recycl, desc_obj_recycl, loca_obj_recycl, date_obj_recycl, id_etat_obj, id_cat_obj, id_inv, id_op_recycl, id_statut_recyclage_obj)
VALUES
('Ordinateur portable Dell', 'Laptop Dell 2016', 'Bâtiment A, salle 101', '2025-01-05', 3, 2, 1, 7, 1),
('Clavier mécanique', 'Clavier pour atelier informatique', 'Bâtiment B, salle 202', '2025-02-02', 3, 2, 1, 1, 1),
('Table de réunion', 'Grande table de réunion', 'Bâtiment C, hall principal', '2025-02-10', 3, 1, 1, 1, 3),
('Scanner HP', 'Scanner de documents', 'Bâtiment A, salle 103', '2025-03-10', 3, 2, 1, 7, 3),
('Tablette Samsung', 'Tablette tactile pour formation', 'Bâtiment D, salle multimédia', '2025-03-15', 4, 2, 1, 7, 1),
('Fauteuil bureau', 'Fauteuil ergonomique', 'Bâtiment E, salle du personnel', '2025-03-18', 3, 1, 1, 7, 1),
('Imprimante laser', 'Imprimante TOSHIBA', 'Bâtiment F, secrétariat', '2025-02-15', 2, 2, 2, 2, 2),
('Projecteur Epson', 'Projecteur pour salle TC', 'Bâtiment G, salle 12', '2025-03-20', 3, 2, 2, 2, 1),
('Table pliante', 'Table modulable', 'Bâtiment H, couloir 3', '2025-03-22', 2, 1, 2, 2, 1),
('Chaises pliantes', 'Lot de 4 chaises', 'Bâtiment G, salle 14', '2025-03-25', 3, 1, 2, 2, 1),
('Bureau modulable', 'Bureau ajustable', 'Bâtiment F, salle 5', '2025-03-28', 4, 1, 2, 2, 1),
('Rangement métallique', 'Armoire métallique', 'Bâtiment H, réserve', '2025-03-30', 3, 1, 2, 2, 3),
('Microscope', 'Microscope TP', 'Laboratoire B, étage 1', '2025-03-28', 3, 3, 3, 3, 2),
('Lot pipettes', 'Pipettes pour expériences', 'Laboratoire B, étage 2', '2025-03-30', 4, 3, 3, 3, 1),
('Ordinateur fixe DELL', 'PC de laboratoire', 'Bâtiment C, salle informatique', '2025-03-01', 4, 2, 3, 6, 1),
('Hotte laboratoire', 'Hotte chimie', 'Laboratoire C, étage 1', '2025-04-02', 3, 3, 3, 3, 3),
('Table expérience', 'Table TP chimie', 'Laboratoire C, étage 2', '2025-04-05', 3, 3, 3, 3, 1),
('Chaise laboratoire', 'Chaise TP', 'Laboratoire B, couloir nord', '2025-04-07', 3, 1, 3, 3, 1),
('Meuble rangement', 'Meuble polyvalent', 'Bâtiment MMI, salle 101', '2025-02-18', 3, 3, 4, 5, 1),
('Table de dessin', 'Table travaux graphiques', 'Bâtiment MMI, atelier 2', '2025-04-05', 3, 3, 4, 5, 2),
('Lot de crayons', 'Crayons pour atelier', 'Bâtiment MMI, salle 105', '2025-04-07', 4, 4, 4, 5, 1),
('Étagère bois', 'Étagère pour matériel', 'Bâtiment MMI, couloir 1', '2025-04-10', 3, 1, 4, 5, 1),
('Table basse', 'Pour espace commun', 'Bâtiment MMI, hall principal', '2025-04-12', 2, 1, 4, 5, 1),
('Chaise pliante', 'Chaise atelier', 'Bâtiment MMI, salle 108', '2025-04-15', 3, 1, 4, 5, 1),
('Manuels droit', 'Manuels récents', 'Faculté droit, salle 201', '2025-04-12', 4, 4, 5, 4, 1),
('Table auxiliaire', 'Petite table TD', 'Faculté droit, salle 202', '2025-04-15', 3, 1, 5, 4, 3),
('Chaise bibliothèque', 'Chaise BU', 'Bibliothèque centrale', '2025-04-18', 3, 1, 5, 4, 1),
('Bureau étudiant', 'Petit bureau', 'Faculté droit, salle 203', '2025-04-20', 3, 1, 5, 4, 1),
('Armoire livres', 'Armoire manuels', 'Bibliothèque centrale', '2025-04-22', 4, 1, 5, 4, 2),
('Manuels mathématiques', 'Lot manuels 1ère année', 'Faculté droit, salle 204', '2025-01-20', 4, 4, 5, 4, 1),
('Éprouvettes', 'Lot de 50 éprouvettes', 'Laboratoire chimie, salle A', '2025-04-20', 3, 3, 6, 6, 1),
('Balance laboratoire', 'Balance analytique', 'Laboratoire chimie, salle B', '2025-04-22', 4, 3, 6, 6, 1),
('Paillasse', 'Paillasse laboratoire', 'Laboratoire chimie, salle C', '2025-04-25', 3, 1, 6, 6, 1),
('Flacons chimiques', 'Lot de 20 flacons', 'Laboratoire chimie, salle D', '2025-04-28', 3, 3, 6, 6, 1),
('Tablier laboratoire', 'Tablier protection', 'Laboratoire chimie, salle E', '2025-04-30', 3, 1, 6, 6, 2),
('Chaise bureau', 'Chaise ergonomique', 'Laboratoire chimie, couloir nord', '2025-01-10', 2, 1, 6, 5, 1),
('Cable HDMI', 'Cable HDMI', '52 Rue des Docteurs Calmette et Guérin Laval, Département Informatique', '2025-04-12', 1, 2, 1, NULL, 1);


-- 26) FORMULAIRE_DONATION
INSERT INTO FORMULAIRE_DONATION 
(date_form_don, just_form_don, id_obj_recycl, id_statut_form_don, id_ut) 
VALUES
('2025-01-08', 'Don d\'un ordinateur pour le futur atelier de réemploi du département Informatique.', 1, 3, 1),
('2025-01-15', 'Don de manuels de biologie à destination de la BU.', 4, 3, 2),
('2025-02-01', 'Mise à disposition d\'une table pour les projets de tutorat étudiants.', 3, 1, 3),
('2025-02-12', 'Don d\'un meuble de rangement pour la salle du personnel.', 8, 2, 4),
('2025-02-25', 'Offre d\'une chaise ergonomique pour le coworking étudiant.', 2, 3, 5),
('2025-03-03', 'Don d\'une imprimante pour le département TC.', 7, 1, 6),
('2025-03-11', 'Cession d\'un lot de câbles et périphériques informatiques.', 9, 3, 7),
('2025-03-15', 'Don d\'un clavier mécanique pour l\'atelier d\'électronique.', 5, 2, 8),
('2025-03-20', 'Offre d\'une table de réunion supplémentaire pour la salle du CERIUM2.', 6, 3, 9),
('2025-03-22', 'Mise à disposition de chaises plastiques pour un événement extérieur.', 10, 1, 10);


-- 27) DEMANDE_OBJET
INSERT INTO DEMANDE_OBJET 
(nom_demande_obj, desc_demande_obj, date_demande_obj, loca_demande_obj, id_statut_demande_obj, id_ut, id_cat_obj) 
VALUES
('Table pliante', 'Besoin pour manger entre collègues le midi dehors', '2025-02-05', '52 Rue des Docteurs Calmette et Guérin Laval, Département Informatique', 1, 18, 1), -- 1 = Mobilier
('Projecteur mobile', 'Pour cours sur les molécules', '2025-02-10', '52 Rue des Docteurs Calmette et Guérin Laval, Département GB', 2, 19, 2), -- 2 = Informatique
('Ordinateur reconditionné', 'Pour tutorat aux 1ère années', '2025-02-12', 'BDE Informatique, 52 Rue des Docteurs Calmette et Guérin Laval', 1, 21, 2),
('Manuels anglais', 'Recherche des manuels pour préparer TOEIC', '2025-02-20', '52 Rue des Docteurs Calmette et Guérin Laval, Département Informatique', 2, 22, 4), -- 4 = Livres fourniture
('Kits VR', 'Expérience VR pour les étudiants', '2025-03-01', 'CERIUM 2 Laval', 1, 19, 2),
('Microphone', 'Pour réunion en distanciel', '2025-03-05', '52 Rue des Docteurs Calmette et Guérin Laval, Département TC', 2, 23, 2),
('10 souris', 'Manque 10 souris dans la salle des MMI', '2025-03-10', '52 Rue des Docteurs Calmette et Guérin Laval, Département MMI', 1, 27, 2),
('Imprimante', 'Besoins administratif', '2025-03-15', '52 Rue des Docteurs Calmette et Guérin Laval, Département TC', 2, 24, 2),
('Chaise de bureau', 'Remplacement', '2025-03-20', '52 Rue des Docteurs Calmette et Guérin Laval, Département TC', 1, 26, 1),
('Kit Lego technique', 'Besoin pour la SAE Robot', '2025-03-22', '52 Rue des Docteurs Calmette et Guérin Laval, Département Informatique', 1, 22, 3); -- 3 = Outils




-- 28) RESERVATION
INSERT INTO RESERVATION 
(date_res, date_exp_res, id_statut_res, id_obj_recycl, id_ut) 
VALUES
('2025-02-01', '2025-02-07', 1, 1, 1),
('2025-02-08', '2025-02-14', 2, 2, 2),
('2025-02-12', '2025-02-19', 1, 3, 6),
('2025-02-20', '2025-02-26', 1, 4, 5),
('2025-03-01', '2025-03-08', 1, 5, 4),
('2025-03-05', '2025-03-12', 1, 6, 10),
('2025-03-09', '2025-03-16', 1, 7, 2),
('2025-03-11', '2025-03-18', 1, 8, 3),
('2025-03-15', '2025-03-22', 2, 9, 9),
('2025-03-18', '2025-03-25', 1, 10, 5);

-- 29) SIGNALEMENT_OBJET
INSERT INTO SIGNALEMENT_OBJET 
(desc_signalement_obj, id_photo, id_res) 
VALUES
('Écran fissuré', 1, 1),
('Assise abîmée', 2, 2),
('Manque une visse', 3, 3),
('Pages déchirées', 4, 4),
('Manque des touches au clavier', 5, 5),
('Tiroir cassé', 6, 6),
('Câble défectueux', 7, 7),
('Tiroir cassé, se ferme mal', 8, 8),
('Ordinateur inutilisable', 9, 9);

-- 30) OBJECTIF_DEVELOPPEMENT_DURABLE
INSERT INTO OBJECTIF_DEVELOPPEMENT_DURABLE 
(nom_objectif, desc_objectif, date_ajout_objectif, id_statut_objectif, id_ut) 
VALUES
('Réduction déchets', 'Diminuer les déchets de 30% avant 5 ans', '2025-01-01', 1, 1),
('Réemploi matériel', 'Favoriser la réutilisation du matériel', '2025-02-01', 1, 2),
('Collecte annuelle', 'Organiser collecte annuelle', '2025-03-01', 1, 5),
('Nombre de sensibilisation', 'Atteindre 5 sessions mensuelles de sensibilisation ODD', '2025-03-15', 1, 7),
('Économie d’énergie', 'Réduire la consommation de 10%', '2025-04-01', 2, 4),
('Don matériel', 'Atteindre 20000 objets donnés avant 2026', '2025-05-01', 1, 6),
('Dons câbles inutilisés', 'Mettre en place des dons de câbles inutilisés', '2025-06-01', 3, 8),
('Bibliothèque verte', 'Réemploi de manuels donnés par les étudiants', '2025-07-01', 1, 5),
('Atelier réparation', 'Ateliers mensuels de réparation de meubles', '2025-08-01', 1, 3),
('Campagne textile', 'Tri et don de vêtements (3/an)', '2025-09-01', 1, 9);

-- 31) NOTIFICATION
INSERT INTO NOTIFICATION 
(message_notif, date_envoi_notif, id_statut_notif, id_type_notif) 
VALUES
('Votre réservation a été confirmée.', '2025-02-01', 2, 4),
('Nouveau formulaire validé.', '2025-02-02', 1, 1),
('Inscription à la sensibilisation aux déchets marins', '2025-02-05', 1, 3),
('Rappel : événement demain', '2025-03-10', 1, 3),
('Signalement reçu', '2025-03-11', 1, 1),
('Rapport trimestriel prêt', '2025-04-01', 1, 1),
('Maintenance inventaire', '2025-04-10', 1, 1),
('Nouvelle communication officielle', '2025-04-15', 1, 1),
('Nouvel objectif pour 2030', '2025-05-01', 1, 1),
('Mise à jour politique', '2025-05-05', 1, 1);


-- 32) NOTIF_UTILISATEUR
INSERT INTO NOTIF_UTILISATEUR (id_ut, id_notification) 
VALUES
(1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10);

-- 33) RAPPORT
INSERT INTO RAPPORT (nom_rapport, date_creation, desc_rapport, id_periode, id_ut) 
VALUES
('Rapport mensuel Jan', '2025-01-31', 'Analyse détaillée des activités réalisées durant le mois de janvier, incluant les indicateurs de performance, les dépenses et les actions menées.', 1, 1),

('Rapport trimestriel Q1', '2025-03-31', 'Synthèse des résultats du premier trimestre avec évaluation des objectifs atteints et recommandations stratégiques pour le trimestre suivant.', 2, 2),

('Rapport annuel 2023', '2024-05-01', 'Bilan complet des actions et performances de l’année 2023, incluant les statistiques globales, les réussites et les axes d’amélioration.', 3, 3),

('Rapport événements', '2025-06-01', 'Compte rendu des événements organisés incluant la participation, l’impact médiatique et l’évaluation logistique.', 2, 4),

('Rapport inventaire', '2025-04-15', 'État des stocks disponibles avec identification des besoins de réapprovisionnement et des pertes constatées.', 1, 5),

('Rapport récolte du département', '2025-05-20', 'Analyse des données de récolte par département avec comparaison aux prévisions et identification des zones à améliorer.', 2, 6),

('Rapport ODD', '2025-07-01', 'Évaluation des actions menées en lien avec les Objectifs de Développement Durable et leur impact environnemental et social.', 3, 7),

('Rapport signalements', '2025-08-01', 'Compilation des signalements reçus, leur traitement et les mesures correctives appliquées.', 1, 8),

('Rapport communication', '2025-09-01', 'Analyse des campagnes de communication, leur portée, engagement et efficacité auprès du public cible.', 2, 9),

('Rapport réutilisation', '2025-10-01', 'Étude sur les initiatives de réutilisation des ressources et leur contribution à la réduction des déchets.', 3, 10);

-- 34) STATS_RAPPORT
INSERT INTO STATS_RAPPORT (id_stats, id_rapport) 
VALUES
(1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10);


-- 35) COMMUNICATION_OFFICIELLE
INSERT INTO COMMUNICATION_OFFICIELLE (titre_comm, contenu_comm, date_comm, id_ut) 
VALUES
('Lancement campagne', 'Lancement de la campagne annuelle de récolte.', '2025-02-01', 1),
('Fermeture temporaire', 'Le point relais BU Laval sera fermé cette semaine.', '2025-02-10', 2),
('Invitation ateliers', 'Ateliers sensibilisation ouverts à l’université.', '2025-03-01', 3),
('Rapport Trimestriel', 'Publication du rapport sur la réduction du CO₂.', '2024-05-01', 4),
('Mise à jour inventaire', 'Inventaire mis à jour.', '2025-04-15', 5),
('Collaboration Vinted', 'Collaboration avec Vinted : -4.99€ sur vos achats.', '2025-05-01', 6),
('Rappel collecte', 'Collecte le mois prochain.', '2025-05-20', 7),
('Résultats tri', 'Résultats du tri annuel.', '2025-06-01', 8),
('Événement annuel', 'Inscription ouverte.', '2025-06-10', 9),
('Clôture campagne', 'Fin de la campagne de dons.', '2025-07-01', 10);

-- 36) BILLET
INSERT INTO BILLET (id_event, id_ut) 
VALUES
(1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10);

-- 37) PHOTO_OBJET
-- chaire, chaise pliante, chaise bureau, chaise BU, chaise laboratoire
INSERT INTO PHOTO_OBJET (id_photo, id_obj_recycl) VALUES
(1, 10), (1, 18), (1, 24), (1, 27), (1, 36);

-- bureaux, bureau modulable, bureau étudiant
INSERT INTO PHOTO_OBJET (id_photo, id_obj_recycl) VALUES
(2, 11), (2, 28), (2, 9); 

-- écran
INSERT INTO PHOTO_OBJET (id_photo, id_obj_recycl) VALUES
(3, 15);

-- poubelle
INSERT INTO PHOTO_OBJET (id_photo, id_obj_recycl) VALUES
(4, 20);

-- étagère bois, rangement métallique, armoire livres
INSERT INTO PHOTO_OBJET (id_photo, id_obj_recycl) VALUES
(5, 12), (5, 22), (5, 29); 

-- table de réunion, table pliante, table expérience, table de dessin, table basse, table auxiliaire
INSERT INTO PHOTO_OBJET (id_photo, id_obj_recycl) VALUES
(6, 3), (6, 9), (6, 17), (6, 20), (6, 23), (6, 26);

-- imprimante laser
INSERT INTO PHOTO_OBJET (id_photo, id_obj_recycl) VALUES
(7, 7);

-- projecteur
INSERT INTO PHOTO_OBJET (id_photo, id_obj_recycl) VALUES
(8, 8);

-- cable HDMI
INSERT INTO PHOTO_OBJET (id_photo, id_obj_recycl) VALUES
(9, 37);




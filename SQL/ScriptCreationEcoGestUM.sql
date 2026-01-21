-- Création de la base de données ecoGestUM

CREATE DATABASE IF NOT EXISTS EcoGestUM CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE EcoGestUM;

-- Création des tables

CREATE TABLE ROLES (
    id_role INT AUTO_INCREMENT PRIMARY KEY,
    nom_role VARCHAR(50)
);

CREATE TABLE STATUT_FORMULAIRE_DONNATION (
    id_statut_form_don INT AUTO_INCREMENT PRIMARY KEY,
    nom_statut_form_don VARCHAR(50),
    CONSTRAINT chk_statut_form_don_valide CHECK (nom_statut_form_don IN ('En attente', 'Refusée', 'Validée'))
);

CREATE TABLE STATUT_OBJET_RECYCLABLE (
    id_statut_recyclage_obj INT AUTO_INCREMENT PRIMARY KEY,
    nom_statut_recyclage_objet VARCHAR(50),
    CONSTRAINT chk_statut_recyclage_valide CHECK (nom_statut_recyclage_objet IN ('disponible', 'réservé', 'en réutilisation', 'en élimination'))
);

CREATE TABLE CATEGORIE_OBJET (
    id_cat_obj INT AUTO_INCREMENT PRIMARY KEY,
    nom_cat_obj VARCHAR(50),
    CONSTRAINT chk_categorie_obj_valide CHECK (nom_cat_obj IN ('Mobiliers', 'Informatique', 'Outils', 'Livres et fournitures'))
);

CREATE TABLE ETAT_OBJET (
    id_etat_obj INT AUTO_INCREMENT PRIMARY KEY,
    nom_etat_obj VARCHAR(50),
    CONSTRAINT chk_etat_obj_valide CHECK (nom_etat_obj IN ('Mauvais état', 'État moyen', 'Bon état', 'Très bon état', 'Neuf'))
);

CREATE TABLE INVENTAIRE (
    id_inv INT AUTO_INCREMENT PRIMARY KEY,
    nom_inv VARCHAR(150)
);

CREATE TABLE UNIVERSITE (
    id_univ INT AUTO_INCREMENT PRIMARY KEY,
    nom_univ VARCHAR(50),
    adr_univ VARCHAR(150),
    id_inv INT,
    FOREIGN KEY (id_inv) REFERENCES INVENTAIRE(id_inv)
);

CREATE TABLE PERIODE (
    id_periode INT AUTO_INCREMENT PRIMARY KEY,
    nom_periode VARCHAR(50) NOT NULL,
    CONSTRAINT chk_periode_valide CHECK (nom_periode IN ('mensuel', 'trimestriel', 'annuel', 'personnalisé'))
);

CREATE TABLE STATUT_RESERVATION (
    id_statut_res INT AUTO_INCREMENT PRIMARY KEY,
    nom_statut_res VARCHAR(50),
    CONSTRAINT chk_statut_res_valide CHECK (nom_statut_res IN ('Prête', 'En préparation'))
);

CREATE TABLE STATUT_NOTIFICATION (
    id_statut_notif INT AUTO_INCREMENT PRIMARY KEY,
    nom_statut_notif VARCHAR(50),
    CONSTRAINT chk_statut_notif_valide CHECK (nom_statut_notif IN ('non lu', 'lu', 'supprimé'))
);

CREATE TABLE TYPE_NOTIF (
    id_type_notif INT AUTO_INCREMENT PRIMARY KEY,
    nom_type_notif VARCHAR(50),
    CONSTRAINT chk_type_notif_valide CHECK (nom_type_notif IN ('information', 'alerte', 'confirmation', 'rappel'))
);

CREATE TABLE STATUT_OBJECTIF (
    id_statut_objectif INT AUTO_INCREMENT PRIMARY KEY,
    nom_statut_objectif VARCHAR(50),
    CONSTRAINT chk_statut_objectif_valide CHECK (nom_statut_objectif IN ('en cours', 'atteint', 'abandonné'))
);

CREATE TABLE STATUT_DEMANDE_OBJET (
    id_statut_demande_obj INT AUTO_INCREMENT PRIMARY KEY,
    nom_statut_demande_obj VARCHAR(50),
    CONSTRAINT chk_statut_demande_obj_valide CHECK (nom_statut_demande_obj IN ('En attente de réponse', 'Répondue'))
);

CREATE TABLE COMPOSANTE (
    id_comp INT AUTO_INCREMENT PRIMARY KEY,
    nom_comp VARCHAR(150),
    adr_comp VARCHAR(150),
    id_univ INT,
    FOREIGN KEY (id_univ) REFERENCES UNIVERSITE(id_univ) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE DEPARTEMENT (
    id_dept INT AUTO_INCREMENT PRIMARY KEY,
    nom_dept VARCHAR(50),
    id_comp INT,
    id_inv INT,
    FOREIGN KEY (id_comp) REFERENCES COMPOSANTE(id_comp) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_inv) REFERENCES INVENTAIRE(id_inv),
    UNIQUE (id_inv)
);

CREATE TABLE STATISTIQUE (
    id_stats INT AUTO_INCREMENT PRIMARY KEY,
    nom_stats VARCHAR(50),
    val_stats FLOAT,
    id_dept INT,
    id_periode INT,
    FOREIGN KEY (id_dept) REFERENCES DEPARTEMENT(id_dept) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_periode) REFERENCES PERIODE(id_periode)
);

CREATE TABLE OPERATION_RECYCLAGE (
    id_op_recycl INT AUTO_INCREMENT PRIMARY KEY,
    nom_op_recycl VARCHAR(50),
    date_op_recycl DATE,
    id_dept INT,
    FOREIGN KEY (id_dept) REFERENCES DEPARTEMENT(id_dept) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE UTILISATEUR (
    id_ut INT AUTO_INCREMENT PRIMARY KEY,
    nom_ut VARCHAR(50),
    pren_ut VARCHAR(50),
    email_ut VARCHAR(50) UNIQUE,
    mdp_ut VARCHAR(100),
    id_univ INT,
    id_comp INT,
    id_dept INT,
    FOREIGN KEY (id_univ) REFERENCES UNIVERSITE(id_univ),
    FOREIGN KEY (id_comp) REFERENCES COMPOSANTE(id_comp),
    FOREIGN KEY (id_dept) REFERENCES DEPARTEMENT(id_dept),
    CONSTRAINT chk_user_structure_academique CHECK ((id_univ IS NOT NULL) OR (id_comp IS NOT NULL) OR (id_dept IS NOT NULL))
);

CREATE TABLE ROLE_UTILISATEUR (
    id_role INT,
    id_ut INT,
    PRIMARY KEY (id_role, id_ut),
    FOREIGN KEY (id_role) REFERENCES ROLES(id_role) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_ut) REFERENCES UTILISATEUR(id_ut) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE OBJECTIF_DEVELOPPEMENT_DURABLE (
    id_objectif INT AUTO_INCREMENT PRIMARY KEY,
    nom_objectif VARCHAR(50),
    desc_objectif TEXT,
    date_ajout_objectif DATE,
    id_statut_objectif INT,
    id_ut INT,
    FOREIGN KEY (id_statut_objectif) REFERENCES STATUT_OBJECTIF(id_statut_objectif),
    FOREIGN KEY (id_ut) REFERENCES UTILISATEUR(id_ut)
);

CREATE TABLE BOITE_DE_RECEPTION (
    id_bdr INT AUTO_INCREMENT PRIMARY KEY,
    id_ut INT,
    FOREIGN KEY (id_ut) REFERENCES UTILISATEUR(id_ut) ON DELETE CASCADE,
    UNIQUE (id_ut)
);

CREATE TABLE CONVERSATION (
    id_conv INT NOT NULL AUTO_INCREMENT,
    id_bdr INT NOT NULL,
    PRIMARY KEY (id_conv, id_bdr),
    FOREIGN KEY (id_bdr) REFERENCES BOITE_DE_RECEPTION(id_bdr) ON DELETE CASCADE
);

CREATE TABLE MESSAGE (
    id_mess INT AUTO_INCREMENT PRIMARY KEY,
    contenu_mess VARCHAR(250),
    date_envoi_mess DATETIME,
    id_ut INT,
    id_ut_1 INT,
    id_conv INT,
    FOREIGN KEY (id_ut) REFERENCES UTILISATEUR(id_ut),
    FOREIGN KEY (id_ut_1) REFERENCES UTILISATEUR(id_ut),
    FOREIGN KEY (id_conv) REFERENCES CONVERSATION(id_conv) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE DEMANDE_OBJET (
    id_demande_obj INT AUTO_INCREMENT PRIMARY KEY,
    nom_demande_obj VARCHAR(50),
    desc_demande_obj TEXT,
    date_demande_obj DATE,
    loca_demande_obj VARCHAR(150),
    id_statut_demande_obj INT,
    id_ut INT,
    id_cat_obj INT,
    FOREIGN KEY (id_statut_demande_obj) REFERENCES STATUT_DEMANDE_OBJET(id_statut_demande_obj),
    FOREIGN KEY (id_ut) REFERENCES UTILISATEUR(id_ut),
    FOREIGN KEY (id_cat_obj) REFERENCES CATEGORIE_OBJET(id_cat_obj)
);

CREATE TABLE OBJET_RECYCLABLE (
    id_obj_recycl INT AUTO_INCREMENT PRIMARY KEY,
    nom_obj_recycl VARCHAR(50),
    desc_obj_recycl TEXT,
    loca_obj_recycl VARCHAR(150),
    date_obj_recycl DATE,
    id_etat_obj INT,
    id_cat_obj INT,
    id_inv INT,
    id_op_recycl INT,
    id_statut_recyclage_obj INT,
    FOREIGN KEY (id_etat_obj) REFERENCES ETAT_OBJET(id_etat_obj),
    FOREIGN KEY (id_cat_obj) REFERENCES CATEGORIE_OBJET(id_cat_obj),
    FOREIGN KEY (id_inv) REFERENCES INVENTAIRE(id_inv),
    FOREIGN KEY (id_op_recycl) REFERENCES OPERATION_RECYCLAGE(id_op_recycl),
    FOREIGN KEY (id_statut_recyclage_obj) REFERENCES STATUT_OBJET_RECYCLABLE(id_statut_recyclage_obj)
);

-- 33) RAPPORT
CREATE TABLE RAPPORT ( id_rapport INT AUTO_INCREMENT PRIMARY KEY, nom_rapport VARCHAR(50), date_creation DATE, desc_rapport TEXT, id_periode INT, id_ut INT, FOREIGN KEY (id_periode) REFERENCES PERIODE(id_periode), FOREIGN KEY (id_ut) REFERENCES UTILISATEUR(id_ut) );


CREATE TABLE COMMUNICATION_OFFICIELLE (
    id_comm INT AUTO_INCREMENT PRIMARY KEY,
    titre_comm VARCHAR(50),
    contenu_comm TEXT,
    date_comm DATE,
    id_ut INT,
    FOREIGN KEY (id_ut) REFERENCES UTILISATEUR(id_ut)
);

CREATE TABLE RESERVATION (
    id_res INT AUTO_INCREMENT PRIMARY KEY,
    date_res DATE,
    date_exp_res DATE,
    id_statut_res INT,
    id_obj_recycl INT,
    id_ut INT,
    FOREIGN KEY (id_statut_res) REFERENCES STATUT_RESERVATION(id_statut_res),
    FOREIGN KEY (id_obj_recycl) REFERENCES OBJET_RECYCLABLE(id_obj_recycl),
    FOREIGN KEY (id_ut) REFERENCES UTILISATEUR(id_ut),
    CONSTRAINT unique_reservation_obj UNIQUE (id_obj_recycl)
);

CREATE TABLE FORMULAIRE_DONATION (
    id_form_don INT AUTO_INCREMENT PRIMARY KEY,
    date_form_don DATE,
    just_form_don TEXT,
    id_obj_recycl INT,
    id_statut_form_don INT,
    id_ut INT,
    FOREIGN KEY (id_obj_recycl) REFERENCES OBJET_RECYCLABLE(id_obj_recycl),
    FOREIGN KEY (id_statut_form_don) REFERENCES STATUT_FORMULAIRE_DONNATION(id_statut_form_don),
    FOREIGN KEY (id_ut) REFERENCES UTILISATEUR(id_ut),
    CONSTRAINT unique_formulaire_don_obj UNIQUE (id_obj_recycl)
);

CREATE TABLE PHOTO (
    id_photo INT AUTO_INCREMENT PRIMARY KEY,
    lien_photo VARCHAR(150)
);

CREATE TABLE PHOTO_OBJET (
    id_photo INT,
    id_obj_recycl INT,
    PRIMARY KEY (id_photo, id_obj_recycl),
    FOREIGN KEY (id_photo) REFERENCES PHOTO(id_photo) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_obj_recycl) REFERENCES OBJET_RECYCLABLE(id_obj_recycl) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE STATS_RAPPORT (
    id_stats INT,
    id_rapport INT,
    PRIMARY KEY (id_stats, id_rapport),
    FOREIGN KEY (id_stats) REFERENCES STATISTIQUE(id_stats) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_rapport) REFERENCES RAPPORT(id_rapport) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE EVENEMENT (
    id_event INT AUTO_INCREMENT PRIMARY KEY,
    nom_event VARCHAR(50),
    desc_event TEXT,
    date_event DATE,
    prix_event FLOAT,
    id_univ INT,
    FOREIGN KEY (id_univ) REFERENCES UNIVERSITE(id_univ)
);

CREATE TABLE BILLET (
    id_event INT,
    id_ut INT,
    Id_billet INT AUTO_INCREMENT,
    PRIMARY KEY (id_event, id_ut),
    FOREIGN KEY (id_event) REFERENCES EVENEMENT(id_event) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_ut) REFERENCES UTILISATEUR(id_ut) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE (Id_billet)
);

CREATE TABLE NOTIFICATION (
    id_notification INT AUTO_INCREMENT PRIMARY KEY,
    message_notif VARCHAR(250),
    date_envoi_notif DATE,
    id_statut_notif INT,
    id_type_notif INT,
    FOREIGN KEY (id_statut_notif) REFERENCES STATUT_NOTIFICATION(id_statut_notif),
    FOREIGN KEY (id_type_notif) REFERENCES TYPE_NOTIF(id_type_notif)
);

CREATE TABLE NOTIF_UTILISATEUR (
    id_ut INT,
    id_notification INT,
    PRIMARY KEY (id_ut, id_notification),
    FOREIGN KEY (id_ut) REFERENCES UTILISATEUR(id_ut) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_notification) REFERENCES NOTIFICATION(id_notification) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE SIGNALEMENT_OBJET (
    id_signalement_obj INT AUTO_INCREMENT PRIMARY KEY,
    desc_signalement_obj TEXT,
    id_photo INT,
    id_res INT,
    FOREIGN KEY (id_photo) REFERENCES PHOTO(id_photo) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_res) REFERENCES RESERVATION(id_res) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT unique_signalement_photo UNIQUE (id_photo)
);


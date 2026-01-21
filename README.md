# EcoGestUM

L'objectif principal est de développer une application qui centralise la gestion du recyclage des équipements et du matériel (meubles, matériel informatique, livres, etc.) au sein de l'Université du Mans dans le cadre de la Situation d'Apprentissage et d'évaluation du semestre 3 du BUT Informatique. Il fut réalisé en groupe de 3 avec 120h/personne.

# Mise en place du projet

1 - clone le repository : git clone https://github.com/rioulantoine/EcoGestUM.git

2 - ouvrez un terminal a la racine du repository et y mettre les commandes suivantes :

    - composer init
    - composer require vlucas/phpdotenv

skippez tout sauf type of project ou vous mettez "project"

# Projet SAE – Application Web de Gestion

## Description

Ce projet est une application web développée en PHP suivant une architecture MVC avec les langages suivants : PHP, HTML, CSS, JavaScript.

## Description

## Mettre en avant le tri au sein de l'Unniversité du Mans.

## Accès au serveur

- **Adresse du serveur :**  
  https://lainf-sae3-6.univ-lemans.fr

---

## URLs de l’application

Base de l’URL :  
https://lainf-sae3-6.univ-lemans.fr/

---

### Pages publiques

- Accueil  
  https://lainf-sae3-6.univ-lemans.fr/accueil

- Connexion  
  https://lainf-sae3-6.univ-lemans.fr/connexion

- Inscription  
  https://lainf-sae3-6.univ-lemans.fr/inscription

- Mot de passe oublié  
  https://lainf-sae3-6.univ-lemans.fr/mot-de-passe-oublie.php

- Politique de confidentialité  
  https://lainf-sae3-6.univ-lemans.fr/notre-politique

- Objectifs  
  https://lainf-sae3-6.univ-lemans.fr/objectifs

- Carte  
  https://lainf-sae3-6.univ-lemans.fr/carte

- Événements  
  https://lainf-sae3-6.univ-lemans.fr/evenements

- Communications officielles  
  https://lainf-sae3-6.univ-lemans.fr/communications

---

### Espace utilisateur

- Profil  
  https://lainf-sae3-6.univ-lemans.fr/profil

- Notifications  
  https://lainf-sae3-6.univ-lemans.fr/notifications

- Messagerie  
  https://lainf-sae3-6.univ-lemans.fr/messagerie

- Mes réservations  
  https://lainf-sae3-6.univ-lemans.fr/mesReservation

- Mes inscriptions  
  https://lainf-sae3-6.univ-lemans.fr/mesInscriptions

---

### Recherche et gestion d’objets

- Recherche d’objets  
  https://lainf-sae3-6.univ-lemans.fr/rechercheObjet

- Formulaire de besoin d’objet  
  https://lainf-sae3-6.univ-lemans.fr/form-besoin-objet

- Besoins objets enseignants  
  https://lainf-sae3-6.univ-lemans.fr/besoins-objet-enseignants

- Formulaire de don  
  https://lainf-sae3-6.univ-lemans.fr/formDon

- Signalement d’objet  
  https://lainf-sae3-6.univ-lemans.fr/signalementObj

---

### Réservations

- Récupérer une réservation  
  https://lainf-sae3-6.univ-lemans.fr/recuperer_reservation

---

### Statistiques et rapports

- Statistiques  
  https://lainf-sae3-6.univ-lemans.fr/statistiques

- Télécharger un rapport  
  https://lainf-sae3-6.univ-lemans.fr/telecharger_rapport

---

### Dashboard (selon le rôle)

- Dashboard principal  
  https://lainf-sae3-6.univ-lemans.fr/dashboard

#### Présidence

- Accueil  
  https://lainf-sae3-6.univ-lemans.fr/dashboard

- Impact  
  https://lainf-sae3-6.univ-lemans.fr/dashboard&section=impact

- Communication  
  https://lainf-sae3-6.univ-lemans.fr/dashboard&section=communication

- Rapport  
  https://lainf-sae3-6.univ-lemans.fr/dashboard&section=rapport

#### Chef de département

- Accueil  
  https://lainf-sae3-6.univ-lemans.fr/dashboard

- Inventaire  
  https://lainf-sae3-6.univ-lemans.fr/dashboard&section=inventaire

- Communication  
  https://lainf-sae3-6.univ-lemans.fr/dashboard&section=communication

- Impact  
  https://lainf-sae3-6.univ-lemans.fr/dashboard&section=impact

- Historique  
  https://lainf-sae3-6.univ-lemans.fr/dashboard&section=historique

Le routage est entièrement géré dans le fichier `index.php` (routeur principal).

### phpMyAdmin

- **URL phpMyAdmin :**  
  https://lainf-sae3-6.univ-lemans.fr/phpmyadmin

> Les identifiants de la base de données sont définis dans le fichier `.env` et ne sont pas inclus directement dans le dépôt pour des raisons de sécurité.

---

## Comptes utilisateurs de test

L’application propose trois rôles distincts :

- Présidence de l’université
- Chef de département
- Enseignant

### Présidence de l’université

- **Login :** monsieur.poisson@univ-lemans.fr  
  **Mot de passe :** mpois1980

- **Login :** alice.dupont@univ-lemans.fr  
  **Mot de passe :** adupo1987

### Chef de département

- **Login :** olivier.roulin@univ-lemans.fr  
  **Mot de passe :** oroul2019

- **Login :** julien.grand@univ-lemans.fr  
  **Mot de passe :** jgran2015

### Enseignant

- **Login :** guillaume.marcel@univ-lemans.fr  
  **Mot de passe :** gmarc2020

- **Login :** juliette.lemoine@univ-lemans.fr  
  **Mot de passe :** jlemo2024

---

## Fonctionnement général

- Le fichier `index.php` joue le rôle de **routeur principal**
- Les paramètres `page`, `section` et `action` permettent de charger :
  - les vues (`/src/view`)
  - les contrôleurs (`/src/Controller`)
  - les modèles (`/src/Model`)
- Les rôles utilisateurs déterminent l’accès aux différentes sections du dashboard

---

## Technologies utilisées

- PHP 8
- MySQL / MariaDB
- phpMyAdmin
- HTML / CSS
- JavaScript
- Composer (autoload)
- Dotenv pour la gestion des variables d’environnement

---

## Remarques

Ce dépôt contient uniquement le code source de l’application.
Les fichiers sensibles (comme `.env`) ne doivent pas être partagés publiquement.

---

© Université du Mans – SAE S3

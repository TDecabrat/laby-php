# Méthode d'installation du projet / dépendances

## PHP
Afin de pouvoir utiliser le projet, il est nécéssaire de disposer du langage PHP.
Afin de l'installer :

- Sous Linux :

Ouvrez un terminal et tapez ces commandes :
sudo apt-get update
sudo apt-get install php

- Sous Windows :

Utilisateur classique :
Installer XAMPP
Lancer XAMPP
Cliquer sur le bouton "shell"

Développeur :

Chercher dans la barre de recherche Windows "Modifier les variables d’environnement système"
Dans "Paramètres système avancés", cliquer sur "Variables d'environnement"
Dans "Variables Systèmes", double-clic sur la variable "Path"
Cliquer sur "Nouveau", puis donner le répertoire contenant le logiciel XAMPP (par défaut : "C:\xampp\php")
Valider le tout en appuyant sur OK


## Démarrage du projet
Afin de pouvoir lancer le projet :

- Sous Linux :
Ouvrez un terminal
Effectuer la commande "cd /chemin/vers/répertoire/projet" ou "cd ~/chemin/vers/répertoire/projet"
Effectuer la commande php -S localhost:12345

- Sous Windows :
Ouvrez un terminal
Effectuer la commande "cd C:/chemin/vers/répertoire/projet"
Effectuer la commande php -S localhost:12345

## Accès au projet
Afin d'accéder au projet, ouvrez votre navigateur et tapez dans la barre d'adresse "http://localhost:12345/menu.php"
 
# power4-php

# Table of contents
1. Choix technique
2. Temps passé
3. Difficultés
4. Sources

## Choix technique
Outils de travail :
- OS : Windows
- PHP : 8.0.30 - via XAMPP + Variable d'environnement

Structure du projet : 
- GameManager s'occupe des actions
- GameState stocke les états de jeu (les entités)
- power4MapGenerator est une classe Factory, elle effectue des informations sur la carte / génère la carte de manière totalement indépendante
- Player/Token permettent de stocker les informations relatives à chacun (la couleur pour le joueur, les coordonnées/la couleur/le chemin pour l'image du token, pour le token)
Cette structure a été prise pour permettre la maintenabilité future du code si besoin (ajouter simplement des joueurs, modifier facilement certaines actions, ajout d'un score).
Cela permet également de réduire les dépendances entre chaque action : il est possible de modifier les résultats renvoyés par le jeu sans que cela influe sur la partie front.

Enfin, nous avons une variable de session qui garde l'état du jeu pour la session en cours, une variable de cookie qui permet d'enregistrer pendant une durée d'une heure
la dernière partie du joueur, et l'importation/exportation de fichiers txt stockant un gameState sérialisé.

## Temps passé

### Vendredi :

16h30 - début
16h45 - initialisation des issues terminée
16h45-16h50 - problème de port php
17h13 - Sprites + Temp Homepage
17h25 - gameState
17h35 - Ajout des documentations + Gestion d'image par défaut pour le pion du joueur
18h00 - Power4MapGenerator (Générateur de la map du jeu) réalisé
18h16 - Tests de liens entre Power4MapGenerator, gameState et entities réalisé : le plateau est algorithmiquement fonctionnel :
la logique du jeu et les actions sont maintenant à réaliser

Travail mis en pause

20h00 - Reprise : début de GameManager
21h30 - Fin de GameManager, travail mis en pause pour la journée.


### Samedi

13h53 - Reprise : début de index
16h17 - Jeu fonctionnel, save/load fonctionnels
17h15 - Refonte du code, simplifications, menu complet

Implémentation du jeu, menu : ~6h40

Fix visibilités + Ordre de chargement des éléments : 15 minutes

Style menu : 20 minutes


### Dimanche

Style puissance 4 : 10 minutes
Fix Logique du jeu + Autres : 20 minutes


### Temps total
7h45


## Difficultés rencontrées
Les principales difficultées rencontrées sont :
- Logique de détection du jeu : comment détecter 4 pièces alignées efficacement ?
- Ordre de chargement : quoi charger en premier, qu'est-ce que cela implique, ...
- Refactorisation du code : peut-être ai-je trop utilisé de stockages différents (cookie, session)


## Sources :
Sprites : https://pixlr.com/fr/editor/
Documentation : aide de GitHub Copilot
Winning check : https://stackoverflow.com/questions/32770321/connect-4-check-for-a-win-algorithm, ramené en php
Download gamestate : https://stackoverflow.com/questions/11545661/php-force-download-json
Problèmes avec export json | serializing : https://stackoverflow.com/questions/10598413/php-json-decode-used-with-a-class-defined-by-me-returns-a-stdclass
# infomaniak
Lʼécole Infomaniak sʼagrandit dʼannée en année, avec toujours plus de campus sʼouvrant
de par le monde. Un des inconvénients majeurs de cet agrandissement est lʼapparition de
nouveaux campus quʼil est parfois difficile de gérer en termes dʼeffectifs et de professeurs.
Afin de palier cet inconvénient, la direction technique de lʼécole a décidé de développer
une application qui permettra de faciliter la gestion du nombre dʼétudiants au sein de
chaque campus, ainsi que la gestion des professeurs. Cette application devra contenir la
liste des campus existants à Infomaniak, ainsi que la liste des étudiants inscrits et des
professeurs donnant cours dans chaque campus.

## Installation

Il faut lancer la commande suivante :

```
./composer.phar install
```
Elle va créer le dossier vendor qui stocke les librairies externe. 
Dans notre projet, elle va mettre en place l'autoload nécessaire pour utiliser les namespaces, ainsi que :a librairie phpunit pour les tests unitaires.


## Lancer le serveur

```
php -S 127.0.0.1:8000 -t web/
```

Cette interface permet de tester la création de campus, etudiant et professeurs avec des données aléatoires.
L'affichage correspond au résultat du getAll

## Tests unitaires

```
phpunit --bootstrap vendor/autoload.php tests
```

ou bien

```
./execTests.sh
```

## Architecture

 - app : code source de l'application
	 - Controller : regroupe les controllers de MVC
	 - Exception : regroupes les Exceptions de l'application
	 - Model : classes modèles utilisé pour structurer les données
	 - Service : classe de services regroupant les fonctions de tri, de sauvegarde
	 - View : regroupe les éléments de vue dans MVC 
 - data : dossier de stockage des données, on trouve les sous-dossiers student, teacher, campus.
 - tests : regroupe les tests unitaires
 - web : c'est le point d'entrée de l'application contenant index.php et les assets (js, img, css)
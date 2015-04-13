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

```
./composer.phar install
```

## Lancer le serveur

```
php -S 127.0.0.1:8000 -t web/
```

## Tests unitaires

```
phpunit --bootstrap vendor/autoload.php tests/Model/StudentTest.php
```

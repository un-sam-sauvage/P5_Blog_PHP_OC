# P5_Blog_PHP_OC

Bienvenue sur mon Blog qui a été réalisé pour le projet 5 de la formation de développeur d'application PHP d'OpenClassrooms.

## Project installation

Pour installer le projet il faut posséder
  - `Xammp` qui permettra de lancer le serveur PHP ainsi que Mysql
  - `Composer` qui permettra d'installer les dépendances nécessaires au projet
  - `Git` qui permettra de cloner le projet depuis Github
  - N'importe quel terminal de commande avec lequel vous avez les droits nécessaires.

### Clonage du projet avec Git

rendez-vous dans le dossier voulu avec votre terminal de commande préféré, et entrez la commande `git clone https://github.com/un-sam-sauvage/P5_Blog_PHP_OC.git`

### Installation de dépendances

Lancez la commande suivante :
- `composer install` qui va installer les dépendances du projet et configurer l'autoloading

Le projet utilise les dépendances suivantes (toutes installées avec composer):
- `AltoRouter` : pour le système de routage de l'application
- `Var dumper` : un composant symfony pour faire du debogage. C'est une version améliorée de `var_dump`

### Database

Lancer le serveur Mysql à partir de Xammp.
Rendez-vous dans le dossier contenant le projet que vous avez cloné avec votre terminal de commande.
Lancer la commande `mysql -u "root" -p "socialnetwork" < data-dump.sql`
Cette commande permettra d'importer la base de donnée dans votre serveur local

Créer le fichier ".env.ini" en copiant ".env-example.ini".

Configurez les infos de connexion à la base de données en remplissant le fichier ".env.ini"

### Start project on local

Pour lancer le projet en local il faut se rendre à la racine du projet avec votre terminal, vérifier de bien avoir lancé Mysql avec Xammp et effectuer la commande `php -S localhost:8000 -t public` qui permettra de lancer le serveur php en local. Donc seul votre machine y aura accès.

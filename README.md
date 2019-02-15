# Projet en responsabilité ASID20.2

membres: 

 - Ariz Hassan
 - Callewaert Florian
 - Jerbouh Amine
 
## Comment installer le projet:

Monter les partitions docker :

```
Docker-compose up -d

# instancier le composer.json
Docker-compose run composer composer install 
Docker-compose exec php-fpm bash

# mettre a jour la database
Php bin/console d:s:u —force 

# charger les fixtures
Php bin/console h:f:l

# créer un compte admin
Php bin/console app:create-admin <adresse mail admin> <password>
```


Fonctionnalités manquantes :
- Le mailer n’a pas pu être créer, par manque de temps.
- La page home ne fonctionne pas si on n'est pas authentifié => passer par /login
- Explication : La home page plante en anonymous car on utiliser *__$this->getUser__ dans la home page
pour récupérer les votes de l'utilisateur connecté pour chaque conférence

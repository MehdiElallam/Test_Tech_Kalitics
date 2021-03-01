# Gestion de pointage 

TEST TECHNIQUE SYMFONY (Kalitics)

## Installation

Utiliser le gestionnaire de dépendances [composer](https://getcomposer.org/) pour installer l'application.

```bash
composer install
```

Aprés veuillez créer la base de données : 

```bash
php bin/console doctrine:database:create
```

Ensuite veuillez executer les migrations :

```bash
php bin/console doctrine:migrations:migrate
```

Et finallement on lance notre serveur :

```bash
symfony server:start --no-tls
```

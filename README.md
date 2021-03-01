# Gestion de pointage 

TEST TECHNIQUE SYMFONY 4 (Kalitics)

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

## Application

La page de connexion :

![alt La page de connexion](https://i.ibb.co/sWkw8qN/login.png)

La page des employées:

![alt La page des employées](https://i.ibb.co/Rg0H1PL/employees.png)

La page des chantiers:

![alt La page des chantiers](https://i.ibb.co/7g4Hcsk/chantiers.png)

La page des pointages:

![alt La page des pointages](https://i.ibb.co/Dw6R4N4/pointages.png)

## Validation des champs

L'employé ne peut pas dépasser 35 heures par semaine

![alt erreur](https://i.ibb.co/HxTkLYW/35heures.png)

L'employé ne peut pas être pointé 2 fois par jour

![alt erreur](https://i.ibb.co/CQNTBV1/deja.png)



## Les packages utilisés 

L'application est sur la version symfony 4.4
- symfony/orm-pack
- symfony/maker-bundle
- symfony/validator
- symfony/security-bundle
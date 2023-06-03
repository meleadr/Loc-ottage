# Loc'ottage

Loc'ottagem est un une application web permettant de réserver des chalets. L'application a été entierement réalisée avec [Vue3](https://vuejs.org/ "Framework Vue3") et [Laravel](https://laravel.com/ "Framework PHP Laravel").

Ce projet a été généré avec Laravel/Vite.

## Versions

Vue 3.2  
PHP 8.1  
Laravel Framework 10.3

## Demonstration

Pas encore disponible

## Démarrer en local

Clonez le projet

```bash
  git clone https://github.com/meleadr/Loc-ottage.git
```

<br />

Allez dans le dossier du projet

```bash
  cd Loc-ottage
```

<br />

Installez les dépendances

```bash
  npm install
```

```bash
  composer update vendor/package --with-dependencies
```

<br />

Démarrez votre serveur local sur le port 8889 (mamp, xampp, wampp, laragon, ...)
<br />
<br />

Créez votre base de données

```bash
  CREATE DATABASE locottage;
```

<br />

Ajoutez le .env dans le projet (Contient les informations de connexion à la base de données)

```bash
  cp .env.example .env
```

<br />

Modifiez le .env avec les informations de connexion à votre base de données

```bash
  - APP_NAME=Loc-ottage
  - DB_PORT=8889
  - DB_DATABASE=locottage
  - DB_USERNAME=root
  - DB_PASSWORD='votre mot de passe'
```

<br />

Effectuez les migrations (Permet de créer les tables de la base de données)

```bash
  php artisan migrate --seed
```

<br />

Démarrez le projet en dev

```bash
  php artisan serve
```

```bash
  npm run dev
```

<br />

Naviguez sur `http://127.0.0.1:8000`.

## Déploiement

Pas encore disponible

## Auteur

[@meleadr](https://www.github.com/meleadr)
[@Foxenz](https://www.github.com/Foxenz)

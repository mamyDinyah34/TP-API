<p align="center">
  <a href="http://nestjs.com/" target="blank"><img src="https://nestjs.com/img/logo-small.svg" width="120" alt="Nest Logo" /></a>
</p>

[circleci-image]: https://img.shields.io/circleci/build/github/nestjs/nest/master?token=abc123def456
[circleci-url]: https://circleci.com/gh/nestjs/nest

  <p align="center">A progressive <a href="http://nodejs.org" target="_blank">Node.js</a> framework for building efficient and scalable server-side applications.</p>
    <p align="center">
<a href="https://www.npmjs.com/~nestjscore" target="_blank"><img src="https://img.shields.io/npm/v/@nestjs/core.svg" alt="NPM Version" /></a>
<a href="https://www.npmjs.com/~nestjscore" target="_blank"><img src="https://img.shields.io/npm/l/@nestjs/core.svg" alt="Package License" /></a>
<a href="https://www.npmjs.com/~nestjscore" target="_blank"><img src="https://img.shields.io/npm/dm/@nestjs/common.svg" alt="NPM Downloads" /></a>
<a href="https://circleci.com/gh/nestjs/nest" target="_blank"><img src="https://img.shields.io/circleci/build/github/nestjs/nest/master" alt="CircleCI" /></a>
<a href="https://coveralls.io/github/nestjs/nest?branch=master" target="_blank"><img src="https://coveralls.io/repos/github/nestjs/nest/badge.svg?branch=master#9" alt="Coverage" /></a>
<a href="https://discord.gg/G7Qnnhy" target="_blank"><img src="https://img.shields.io/badge/discord-online-brightgreen.svg" alt="Discord"/></a>
<a href="https://opencollective.com/nest#backer" target="_blank"><img src="https://opencollective.com/nest/backers/badge.svg" alt="Backers on Open Collective" /></a>
<a href="https://opencollective.com/nest#sponsor" target="_blank"><img src="https://opencollective.com/nest/sponsors/badge.svg" alt="Sponsors on Open Collective" /></a>
  <a href="https://paypal.me/kamilmysliwiec" target="_blank"><img src="https://img.shields.io/badge/Donate-PayPal-ff3f59.svg" alt="Donate us"/></a>
    <a href="https://opencollective.com/nest#sponsor"  target="_blank"><img src="https://img.shields.io/badge/Support%20us-Open%20Collective-41B883.svg" alt="Support us"></a>
  <a href="https://twitter.com/nestframework" target="_blank"><img src="https://img.shields.io/twitter/follow/nestframework.svg?style=social&label=Follow" alt="Follow us on Twitter"></a>
</p>
  <!--[![Backers on Open Collective](https://opencollective.com/nest/backers/badge.svg)](https://opencollective.com/nest#backer)
  [![Sponsors on Open Collective](https://opencollective.com/nest/sponsors/badge.svg)](https://opencollective.com/nest#sponsor)-->

## Description

Implémentation simple d'une API CRUD pour la gestion des utilisateurs avec [NestJS](https://github.com/nestjs/nest) et PostgreSQL.

## Fonctionnalités ✨

- **CRUD Utilisateurs** : Opérations de base (Create, Read, Update, Delete)
- **Base de données PostgreSQL** : Stockage des données utilisateur
- **Prisma ORM** : Pour une gestion efficace de la base de données
- **TypeScript** : Pour un code robuste et typé

## Installation 🚀

1. **Installez les dépendances** :
```bash
$ npm install
```

2. **Configurez la base de données** :
Créez un fichier `.env` à la racine du projet avec :
```env
DATABASE_URL="postgresql://postgres:your_password@localhost:5432/usernest"
```

3. **Exécutez les migrations** :
```bash
$ npx prisma migrate dev
```

4. **Démarrez le serveur** :
```bash
$ npm run start:dev
```

## Routes API 📡

### Utilisateurs

- **GET /users** : Liste tous les utilisateurs
- **GET /users/:id** : Récupère un utilisateur spécifique
- **POST /users** : Crée un nouvel utilisateur
  ```json
  {
    "name": "John Doe",
    "email": "john@example.com",
    "password": "secret123"
  }
  ```
- **PUT /users/:id** : Met à jour un utilisateur
  ```json
  {
    "name": "John Updated",
    "email": "john.updated@example.com"
  }
  ```
- **DELETE /users/:id** : Supprime un utilisateur

## Tests de l'API 🧪

Vous pouvez tester l'API avec des outils comme :
- [Postman](https://www.postman.com/)
- [Thunder Client](https://www.thunderclient.com/) (extension VS Code)
- [cURL](https://curl.se/)

Exemple de requête avec cURL :
```bash
# Créer un utilisateur
curl -X POST http://localhost:3000/users \
  -H "Content-Type: application/json" \
  -d '{"name":"John Doe","email":"john@example.com","password":"secret123"}'

# Lister tous les utilisateurs
curl http://localhost:3000/users
```

## Structure du Projet 📁

```
src/
├── users/
│   ├── users.controller.ts   # Contrôleur pour les routes
│   └── users.service.ts      # Service pour la logique métier
├── app.module.ts             # Module principal
└── main.ts                   # Point d'entrée
```

## Ressources Utiles 📚

- [Documentation NestJS](https://docs.nestjs.com)
- [Documentation Prisma](https://www.prisma.io/docs)
- [TypeScript Handbook](https://www.typescriptlang.org/docs/handbook/intro.html)

## Licence

Ce projet est sous licence MIT.

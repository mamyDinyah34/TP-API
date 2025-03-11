# CRUD API avec Authentification et PostgreSQL (Laravel, Express & NestJS) 🔐

Ce projet est une **API CRUD** pour la gestion des utilisateurs avec authentification par **JWT**, **PostgreSQL** comme base de données, et une documentation via **Swagger** (pour Laravel et Express). Il comprend trois parties : une implémentation avec **Laravel**, une avec **Express.js**, et une version simple avec **NestJS**.

---

## Fonctionnalités ✨

- **Gestion des Utilisateurs** : Inscription, Connexion, Mise à jour et Suppression des utilisateurs.
- **Authentification JWT** : Accès sécurisé via **JSON Web Tokens** pour les routes protégées.
- **Documentation Swagger** : Documentation claire et interactive de l'API pour Laravel et Express.
- **Base de données PostgreSQL** : Stockage fiable des utilisateurs et des informations.

---

## Capture d'Écran 📸

| ![laravel](https://github.com/user-attachments/assets/6717c2dd-490b-4cf6-8867-0b18770babf3)| ![express](https://github.com/user-attachments/assets/4811b79f-1884-46cd-a042-abcf4d7a1899) |
|---|---|
| Documentation Swagger pour Laravel | Documentation Swagger pour Express |

---

## Langages et Technologies Utilisées 🛠️

- **Laravel (PHP)** : Framework PHP pour l'implémentation de l'API RESTful avec JWT.
- **Express.js (Node.js)** : Framework minimaliste pour la création d'API avec Prisma.
- **NestJS (Node.js)** : Framework moderne pour créer des applications Node.js efficaces et scalables.
- **PostgreSQL** : Base de données relationnelle pour stocker les utilisateurs.
- **Prisma** : ORM moderne pour Node.js et TypeScript.
- **Swagger** : Documentation de l'API (Laravel et Express).
- **JWT** : Pour sécuriser les routes (Laravel et Express).

---

## Installation 🚀

### Étapes d'Installation 🔨

Dans ce projet, vous trouverez trois dossiers : **Laravel**, **Express.js** et **NestJS**. Chaque implémentation a ses propres spécificités.

**1. Clonez ce dépôt** : `git clone https://github.com/mamyDinyah34/TP-CRUD-API.git`

#### Laravel (API Complète avec JWT et Swagger)

| **Étape** | **Commande/Action** |
|------------|-------------------|
| **Dossier** | `cd TP-CRUD-API/laravel` |
| **Dépendances** | `composer install` |
| **Base de données** | Dans `.env` :<br>```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=userlaravel
DB_USERNAME=postgres
DB_PASSWORD=your_password
``` |
| **Migrations** | `php artisan migrate` |
| **Documentation** | `php artisan l5-swagger:generate` |
| **Démarrage** | `php artisan serve` |
| **Interface** | [http://localhost:8000/api/documentation](http://localhost:8000/api/documentation) |

#### Express.js (API Complète avec JWT et Swagger)

| **Étape** | **Commande/Action** |
|------------|-------------------|
| **Dossier** | `cd TP-CRUD-API/express` |
| **Dépendances** | `npm install` |
| **Base de données** | Dans `.env` :<br>```env
DATABASE_URL="postgresql://postgres:your_password@localhost:5432/userexpress"
``` |
| **Migrations** | `npx prisma migrate dev` |
| **Démarrage** | `node app.js` |
| **Interface** | [http://localhost:5000/api/docs](http://localhost:5000/api/docs) |

#### NestJS (API CRUD Simple)

| **Étape** | **Commande/Action** |
|------------|-------------------|
| **Dossier** | `cd TP-CRUD-API/nest` |
| **Dépendances** | `npm install` |
| **Base de données** | Dans `.env` :<br>```env
DATABASE_URL="postgresql://postgres:your_password@localhost:5432/usernest"
``` |
| **Migrations** | `npx prisma migrate dev` |
| **Démarrage** | `npm run start:dev` |
| **Test** | Utilisez Postman ou Thunder Client |

---

## Routes API 📡

### Authentification (Laravel et Express)

- **POST /api/login  -- /login** : Connexion d'un utilisateur (Retourne un token JWT)
- **POST /api/register --  /register** : Inscription d'un nouvel utilisateur

### Utilisateurs (Laravel et Express)

- **GET /api/users** : Liste de tous les utilisateurs
- **POST /api/users** : Créer un nouvel utilisateur
- **PUT /api/users/{id}** : Mettre à jour un utilisateur
- **DELETE /api/users/{id}** : Supprimer un utilisateur

### Déconnexion (Laravel et Express)

- **POST /logout** : Déconnexion de l'utilisateur (Invalidate le token JWT)

### NestJS (CRUD Simple)

- **GET /users** : Liste de tous les utilisateurs
- **GET /users/:id** : Obtenir un utilisateur spécifique
- **POST /users** : Créer un nouvel utilisateur
- **PUT /users/:id** : Mettre à jour un utilisateur
- **DELETE /users/:id** : Supprimer un utilisateur

---

## Sécurité 🔒

- **JWT** : Utilisation de **JSON Web Tokens (JWT)** pour sécuriser l'accès aux routes protégées.
- **Routes protégées** : Certaines routes nécessitent un **token JWT** valide (par exemple, la mise à jour ou la suppression des utilisateurs).

---

## Tests des APIs 🧪

### Laravel et Express (avec Swagger)
Une fois le serveur démarré, vous pouvez utiliser **Swagger UI** pour tester les différentes routes API de manière interactive. N'oubliez pas d'envoyer votre **token JWT** dans l'en-tête **Authorization** de vos requêtes (par exemple : `Bearer <token>`).

### NestJS (CRUD Simple)
Pour tester l'API NestJS, vous pouvez utiliser des outils comme **cURL**, **Postman** ou **Thunder Client**. Les routes sont simples et ne nécessitent pas d'authentification.

## Différences entre les Implémentations 🔄

- **Laravel & Express** : Implémentation complète avec authentification JWT et documentation Swagger.
- **NestJS** : Version simple du CRUD, focalisée sur les opérations de base avec Prisma comme ORM.

---

© Mamy Dinyah - 2025

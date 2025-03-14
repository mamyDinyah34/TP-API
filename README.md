# CRUD API avec Authentification et PostgreSQL (Laravel, Express, NestJS & Spring Boot) 🔐

Ce TP est une **API CRUD** pour la gestion des utilisateurs avec authentification par **JWT**, **PostgreSQL** comme base de données, et une documentation via **Swagger** (pour Laravel et Express). Il comprend quatre parties : une implémentation avec **Laravel**, une avec **Express.js**, une version simple avec **NestJS**, et une version Spring Boot pour un CRUD simple.

---

## Fonctionnalités ✨

- **Gestion des Utilisateurs** : Inscription, Connexion, Mise à jour et Suppression des utilisateurs.
- **Authentification JWT** : Accès sécurisé via **JSON Web Tokens** pour les routes protégées.
- **Documentation Swagger** : Documentation claire et interactive de l'API pour Laravel et Express.
- **Base de données PostgreSQL** : Stockage fiable des utilisateurs et des informations.
- **CRUD Simple avec Spring Boot** : Une implémentation simple du CRUD avec Spring Boot.

---

## Capture d'Écran 📸

| ![laravel](https://github.com/user-attachments/assets/6717c2dd-490b-4cf6-8867-0b18770babf3) | ![express](https://github.com/user-attachments/assets/4811b79f-1884-46cd-a042-abcf4d7a1899) |
|---|---|
| Documentation Swagger pour Laravel | Documentation Swagger pour Express |

---

## Langages et Technologies Utilisées 🛠️

- **Laravel (PHP)** : Framework PHP pour l'implémentation de l'API RESTful avec JWT.
- **Express.js (Node.js)** : Framework minimaliste pour la création d'API avec Prisma.
- **NestJS (Node.js)** : Framework moderne pour créer des applications Node.js efficaces et scalables.
- **Spring Boot (Java)** : Framework Java pour la création de microservices et d'API RESTful.
- **PostgreSQL** : Base de données relationnelle pour stocker les utilisateurs.
- **Prisma** : ORM moderne pour Node.js et TypeScript (utilisé avec Express et NestJS).
- **Swagger** : Documentation de l'API (Laravel et Express).
- **JWT** : Pour sécuriser les routes (Laravel et Express).

---

## Installation 🚀

1. **Clonez ce dépôt** : `git clone https://github.com/mamyDinyah34/TP-CRUD-API.git`
   
### Étapes pour Laravel

2. **Allez dans le dossier** : `cd TP-CRUD-API/laravel`
3. **Installez les dépendances** : `composer install`
4. **Configurez la base de données** : Modifiez le fichier `.env` avec les configurations PostgreSQL
5. **Migrations** : `php artisan migrate`
6. **Démarrez le serveur** : `php artisan serve`

### Étapes pour Express

2. **Allez dans le dossier** : `cd TP-CRUD-API/express`
3. **Installez les dépendances** : `npm install`
4. **Configurez la base de données** : Modifiez le fichier `.env` et définissez `DATABASE_URL`
5. **Migrations** : `npx prisma migrate dev`
6. **Démarrez le serveur** : `node app.js`

### Étapes pour NestJS

2. **Allez dans le dossier** : `cd TP-CRUD-API/nest`
3. **Installez les dépendances** : `npm install`
4. **Configurez la base de données** : Modifiez le fichier `.env` et définissez `DATABASE_URL`
5. **Migrations** : `npx prisma migrate dev`
6. **Démarrez le serveur** : `npm run start:dev`

### Étapes pour Spring Boot

2. **Allez dans le dossier Spring Boot** : `cd TP-CRUD-API/springboot`
3. **Installez les dépendances** : `./mvnw clean install`
4. **Configurez la base de données** : Modifiez le fichier `application.properties` avec les configurations PostgreSQL :
   ```properties
   spring.datasource.url=jdbc:postgresql://localhost:5432/userspring
   spring.datasource.username=postgres
   spring.datasource.password=your_password
   spring.jpa.hibernate.ddl-auto=update
   spring.jpa.properties.hibernate.format_sql=true


## Routes API 📡

### Laravel

- **POST /api/login** : Connexion d'un utilisateur (Retourne un token JWT)
- **POST /api/register** : Inscription d'un nouvel utilisateur
- **GET /api/users** : Liste de tous les utilisateurs
- **POST /api/users** : Créer un nouvel utilisateur
- **PUT /api/users/{id}** : Mettre à jour un utilisateur
- **DELETE /api/users/{id}** : Supprimer un utilisateur
- **POST /logout** : Déconnexion de l'utilisateur (Invalidate le token JWT)


### Express

- **POST /login** : Connexion d'un utilisateur (Retourne un token JWT)
- **POST /register** : Inscription d'un nouvel utilisateur
- **GET /users** : Liste de tous les utilisateurs
- **POST /users** : Créer un nouvel utilisateur
- **PUT /users/:id** : Mettre à jour un utilisateur
- **DELETE /users/:id** : Supprimer un utilisateur
- **POST /logout** : Déconnexion de l'utilisateur (Invalidate le token JWT)

### NestJS (CRUD Simple)

- **GET /users** : Liste de tous les utilisateurs
- **GET /users/:id** : Obtenir un utilisateur spécifique
- **POST /users** : Créer un nouvel utilisateur
- **PUT /users/:id** : Mettre à jour un utilisateur
- **DELETE /users/:id** : Supprimer un utilisateur

### Spring Boot (CRUD Simple)

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
Une fois le serveur démarré, vous pouvez utiliser **Swagger UI** pour tester les différentes routes API de manière interactive. N'oubliez pas d'envoyer votre **token JWT** dans l'en-tête **Authorization**.

### NestJS & Spring Boot (CRUD Simple)
Pour tester l'API NestJS et Spring Boot, vous pouvez utiliser des outils comme **cURL**, **Postman** ou **Thunder Client**. Les routes sont simples et ne nécessitent pas d'authentification.

## Différences entre les Implémentations 🔄

- **Laravel & Express** : Implémentation complète avec authentification JWT et documentation Swagger.
- **NestJS & Spring Boot** : Version simple du CRUD, focalisée sur les opérations de base avec Prisma(NestJS) ou JPA (Spring Boot) comme ORM.

---

© Mamy Dinyah - 2025

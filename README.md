# CRUD API avec Authentification et PostgreSQL (Laravel & Express) 🔐

Ce projet est une **API CRUD** pour la gestion des utilisateurs avec authentification par **JWT**, **PostgreSQL** comme base de données, et une documentation via **Swagger**. Il comprend deux parties : une implémentation avec **Laravel** et une autre avec **Express.js**.

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
- **Express.js (Node.js)** : Framework minimaliste pour la création d'API avec Prisma pour gérer la base de données.
- **PostgreSQL** : Base de données relationnelle pour stocker les utilisateurs.
- **Swagger** : Génération automatique de la documentation de l'API pour les deux environnements (Laravel & Express).
- **JWT (JSON Web Token)** : Pour sécuriser les routes et gérer l'authentification des utilisateurs.

---

## Installation 🚀

### Étapes pour Laravel et Express

Dans ce projet, vous trouverez deux dossiers, un pour **Laravel** et un autre pour **Express.js**. Suivez les étapes d'installation pour chaque environnement.

| **Étapes**                                               | **Laravel et Express**                                         |
|----------------------------------------------------------|---------------------------------------------------------------|
| **1. Clonez ce dépôt**                                   | Clonez le dépôt depuis GitHub :                               |
|                                                          |   https://github.com/mamyDinyah34/TP-API.git                  |
| **2. Allez dans le dossier correspondant (Laravel ou Express)** |  - Pour Laravel : `cd TP-API/laravel`                         |
|                                                          | - Pour Express : `cd TP-API/express`                         |
| **3. Installez les dépendances**                         |  - Pour Laravel : `composer install`                          |
|                                                          |  - Pour Express : `npm install`                               |
| **4. Configurez la base de données PostgreSQL**          | Modifiez le fichier `.env` dans le dossier correspondant :     |
|                                                          |   - Pour Laravel :                                              |
|                                                          |     - `DB_CONNECTION=pgsql`                                    |
|                                                          |     - `DB_HOST=127.0.0.1`                                      |
|                                                          |     - `DB_PORT=5432`                                          |
|                                                          |     - `DB_DATABASE=userlaravel`                                   |
|                                                          |     - `DB_USERNAME=postgres`                                   |
|                                                          |     - `DB_PASSWORD=your_password`                              |
|                                                          |   - Pour Express : `DATABASE_URL="postgresql://postgres:your_password@localhost:5432/userexpress"` |
| **5. Exécutez les migrations pour la base de données**   | - Pour Laravel : `php artisan migrate`                         |
|                                                          | - Pour Express : `npx prisma migrate dev`                      |
| **6. Générez la documentation Swagger**                  | - Pour Laravel : `php artisan l5-swagger:generate`             |
| **7. Démarrez le serveur**                               | - Pour Laravel : `php artisan serve`                           |
|                                                          | - Pour Express : ` node app.js`                                   |
| **8. Accédez à la documentation Swagger**                | - Pour Laravel : [http://localhost:8000/api/documentation](http://localhost:8000/api/documentation) |
|                                                          | - Pour Express : [http://localhost:5000/api/docs](http://localhost:5000/api/docs) |

---

## Routes API 📡

### Authentification

- **POST /api/login  -- /login** : Connexion d'un utilisateur (Retourne un token JWT)
- **POST /api/register --  /register** : Inscription d'un nouvel utilisateur

### Utilisateurs

- **GET /api/users** : Liste de tous les utilisateurs
- **POST /api/users** : Créer un nouvel utilisateur
- **PUT /api/users/{id}** : Mettre à jour un utilisateur
- **DELETE /api/users/{id}** : Supprimer un utilisateur

### Déconnexion

- **POST /logout** : Déconnexion de l'utilisateur (Invalidate le token JWT)

---

## Sécurité 🔒

- **JWT** : Utilisation de **JSON Web Tokens (JWT)** pour sécuriser l'accès aux routes protégées.
- **Routes protégées** : Certaines routes nécessitent un **token JWT** valide (par exemple, la mise à jour ou la suppression des utilisateurs).

---

## Tests avec Swagger 🧪

Une fois le serveur démarré, vous pouvez utiliser **Swagger UI** pour tester les différentes routes API de manière interactive. N'oubliez pas d'envoyer votre **token JWT** dans l'en-tête **Authorization** de vos requêtes (par exemple : `Bearer <token>`).

---

© Mamy Dinyah - 2025

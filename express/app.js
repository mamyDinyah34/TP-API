const express = require("express");
require("dotenv").config();

const { PrismaClient } = require('@prisma/client')
const prisma = new PrismaClient();
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');

const swaggerJsdoc = require("swagger-jsdoc");
const swaggerUi = require("swagger-ui-express");


const app = express();
app.use(express.json());


const options = {
  definition: {
    openapi: "3.0.0",
    info: {
      title: "API de Gestion des Utilisateurs avec Swagger",
      version: "0.1.0",
      description:
        "Documentation de l\'API pour la gestion des utilisateurs avec Swagger",
    },
    servers: [
      {
        url: "http://localhost:5000/",
      },
    ],
    components: {
        securitySchemes: {
            bearerAuth: {
                type: 'http',
                scheme: 'bearer',
                bearerFormat: 'JWT',
            }
        }
    },
    security: [{
        bearerAuth: []
    }]
  },
  apis: ["./app.js"],
};


const specs = swaggerJsdoc(options);
app.use(
  "/api-docs",
  swaggerUi.serve,
  swaggerUi.setup(specs)
);
const port = process.env.PORT || 5000;

app.listen(port, () => {
  console.log(`Server listening on ${port}`);
});

const generateToken = (user) => {
  return jwt.sign({ id: user.id, email: user.email }, process.env.JWT_SECRET, { expiresIn: '1h' });
};


/**
 * @swagger
 * /register:
 *   post:
 *     summary: Inscription d'un nouvel utilisateur
 *     description: Crée un utilisateur et retourne un token JWT.
 *     tags: [Auth]
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             type: object
 *             properties:
 *               name:
 *                 type: string
 *                 example: Mamy Dinyah
 *                 description: Nom de l'utilisateur
 *               email:
 *                 type: string
 *                 example: mamydinyah@gmail.com
 *                 description: Adresse email de l'utilisateur
 *               password:
 *                 type: string
 *                 example: "password123"
 *                 description: Mot de passe de l'utilisateur
 *     responses:
 *       201:
 *         description: Utilisateur créé avec succès
 *       500:
 *         description: Erreur serveur
 */

app.post('/register', async (req, res) => {
  const { name, email, password } = req.body;
  try {
    const hashedPassword = await bcrypt.hash(password, 10);
    const user = await prisma.user.create({
      data: {name, email, password: hashedPassword}
    });
    const token = generateToken(user);
    res.status(201).json({ user, token });
  } catch (error) {
    res.status(500).json({ error: 'Erreur lors de l\'inscription' });
  }
});


/**
 * @swagger
 * /login:
 *   post:
 *     summary: Connexion d'un utilisateur
 *     description: Authentifie un utilisateur et retourne un token JWT.
 *     tags: [Auth]
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             type: object
 *             properties:
 *               email:
 *                 type: string
 *                 example: mamydinyah@gmail.com
 *               password:
 *                 type: string
 *                 example: "password123"
 *     responses:
 *       200:
 *         description: Connexion réussie
 *       401:
 *         description: Identifiants invalides
 *       500:
 *         description: Erreur serveur
 */
app.post('/login', async (req, res) => {
  const { email, password } = req.body;
  try {
    const user = await prisma.user.findUnique({ where: { email } });
    if (!user || !await bcrypt.compare(password, user.password)) {
      return res.status(401).json({ error: 'Email ou mot de passe incorrect' });
    }
    const token = generateToken(user);
    res.json({ user, token });
  } catch (error) {
    res.status(500).json({ error: 'Erreur lors de la connexion' });
  }
});

const authenticateJWT = (req, res, next) => {
  const token = req.header('Authorization')?.split(' ')[1];
  //console.log('Toke:', token);
  if (!token) return res.status(403).json({ error: 'Token manquant' });

  jwt.verify(token, process.env.JWT_SECRET, (err, user) => {
    if (err) {
      console.error('Erreur JWT:', err);
      return res.status(403).json({ error: 'Token invalide' });
    }
    req.user = user;
    next();
  });
};


/**
 * @swagger
 * /users:
 *   get:
 *     summary: Récupérer la liste des utilisateurs
 *     description: Retourne la liste complète des utilisateurs enregistrés.
 *     tags: [Users]
 *     responses:
 *       200:
 *         description: Liste des utilisateurs
 *       500:
 *         description: Erreur serveur
 */

app.get('/users', async (req, res) => {
  try {
    const users = await prisma.user.findMany();
    res.json(users);
  } catch (error) {
    res.status(500).json({ error: 'Erreur lors de la récupération des utilisateurs' });
  }
});


/**
 * @swagger
 * /users/{id}:
 *   get:
 *     security:
 *       - bearerAuth: []
 *     summary: Récupérer un utilisateur par ID
 *     description: Retourne un utilisateur spécifique en fonction de son ID.
 *     tags: [Users]
 *     parameters:
 *       - in: path
 *         name: id
 *         required: true
 *         schema:
 *           type: integer
 *         description: ID de l'utilisateur
 *     responses:
 *       200:
 *         description: Détails de l'utilisateur
 *       404:
 *         description: Utilisateur non trouvé
 *       500:
 *         description: Erreur serveur
 */
app.get('/users/:id', authenticateJWT, async (req, res) => {
  try {
    const userId = parseInt(req.params.id);
    const user = await prisma.user.findUnique({
      where: { id: userId },
    });

    if (!user) {
      return res.status(404).json({ error: 'Utilisateur non trouvé' });
    }

    res.json(user);
  } catch (error) {
    console.error('Erreur lors de la récupération de l\'utilisateur:', error);
    res.status(500).json({ error: 'Erreur lors de la récupération de l\'utilisateur' });
  }
});

/**
 * @swagger
 * /users/{id}:
 *   put:
 *     summary: Mettre à jour un utilisateur
 *     description: Modifie les informations d'un utilisateur.
 *     tags: [Users]
 *     security:
 *       - bearerAuth: []
 *     parameters:
 *       - in: path
 *         name: id
 *         required: true
 *         schema:
 *           type: integer
 *         description: ID de l'utilisateur
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             type: object
 *             properties:
 *               name:
 *                 type: string
 *                 example: Jane Doe
 *               email:
 *                 type: string
 *                 example: jane@example.com
 *               password:
 *                 type: string
 *                 example: "newpassword123"
 *     responses:
 *       200:
 *         description: Utilisateur mis à jour
 *       404:
 *         description: Utilisateur non trouvé
 *       500:
 *         description: Erreur serveur
 */
app.put('/users/:id', authenticateJWT, async (req, res) => {
  try {
    const userId = parseInt(req.params.id);
    const { name, email, password } = req.body;
    const updatedUser = await prisma.user.update({
      where: { id: userId },
      data: { name, email, password },
    });
    res.json(updatedUser);
  } catch (error) {
    console.error('Erreur lors de la mise à jour de l\'utilisateur:', error);
    res.status(500).json({ error: 'Erreur lors de la mise à jour de l\'utilisateur' });
  }
});

/**
 * @swagger
 * /users/{id}:
 *   delete:
 *     summary: Supprimer un utilisateur
 *     description: Supprime un utilisateur en fonction de son ID.
 *     tags: [Users]
 *     security:
 *       - bearerAuth: []
 *     parameters:
 *       - in: path
 *         name: id
 *         required: true
 *         schema:
 *           type: integer
 *         description: ID de l'utilisateur
 *     responses:
 *       200:
 *         description: Utilisateur supprimé
 *       404:
 *         description: Utilisateur non trouvé
 *       500:
 *         description: Erreur serveur
 */
app.delete('/users/:id', authenticateJWT, async (req, res) => {
  try {
    const userId = parseInt(req.params.id);
    const deletedUser = await prisma.user.delete({
      where: { id: userId },
    });
    res.json(deletedUser);
  } catch (error) {
    console.error('Erreur lors de la suppression de l\'utilisateur:', error);
    res.status(500).json({ error: 'Erreur lors de la suppression de l\'utilisateur' });
  }
});

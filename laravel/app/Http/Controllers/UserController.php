<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

   /**
    * @OA\Get(
    *     path="/api/users",
    *     summary="Récupérer tous les utilisateurs",
    *     tags={"Utilisateurs"},
    *     @OA\Response(
    *         response=200,
    *         description="Liste des utilisateurs",
    *         @OA\JsonContent(
    *             type="array",
    *             @OA\Items(
    *                 type="object",
    *                 @OA\Property(property="id", type="integer", example=1),
    *                 @OA\Property(property="name", type="string", example="Mamy Dinyah"),
    *                 @OA\Property(property="email", type="string", example="mamydinyah@gmail.com"),
    *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-03-10T10:00:00Z"),
    *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-03-10T10:00:00Z")
    *             )
    *         )
    *     )
    * )
    */
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
    * @OA\Post(
    *     path="/api/register",
    *     summary="Créer un nouvel utilisateur",
    *     tags={"Auth"},
    *     @OA\Parameter(name="name", in="query", description="Nom", required=true, @OA\Schema(type="string")),
    *     @OA\Parameter(name="email", in="query", description="Email", required=true, @OA\Schema(type="string", format="email")),
    *     @OA\Parameter(name="password", in="query", description="Mot de passe", required=true, @OA\Schema(type="string", format="password")),
    *     @OA\Response(response=201, description="Utilisateur créé"),
    *     @OA\Response(response=500, description="Erreur serveur")
    * )
    */
    public function store(Request $request)
    {
        /*$fields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);*/

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        //$user = User::create($fields);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        //$token = $user->createToken($request->name);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'user' => $user,
            //'token' =>$token->plainTextToken,
            'token' =>$token,
        ],
        201);
    }

    /**
     * Display the specified resource.
     */
    /*public function show(User $user)
    {
        return response()->json($user, 200);
    }*/

    /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *     summary="Récupérer un utilisateur par ID",
     *     tags={"Utilisateurs"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de l'utilisateur",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Utilisateur trouvé avec succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Utilisateur non trouvé",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Utilisateur non trouvé")
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Non autorisé",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Non autorisé")
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }

        if (auth()->id() !== $user->id) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     */

     /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     summary="Mettre à jour un utilisateur",
     *     tags={"Utilisateurs"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'utilisateur",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password"},
     *             @OA\Property(property="name", type="string", example="Mamy Dinyah"),
     *             @OA\Property(property="email", type="string", example="mamydinyah@gmail.com"),
     *             @OA\Property(property="password", type="string", example="newpassword123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Utilisateur mis à jour avec succès",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Utilisateur mis à jour"),
     *             @OA\Property(property="user", type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="email", type="string"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request - Validation échouée",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Les données envoyées ne sont pas valides")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Non autorisé",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Non autorisé")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Utilisateur non trouvé",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Utilisateur non trouvé")
     *         )
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }
        
        if (!auth()->check()) {
            return response()->json(['message' => 'Non autorisé'], 401);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:6',
        ]);

        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return response()->json(['message' => 'Utilisateur mis à jour', 'user' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    /*public function destroy(User $user)
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'Utilisateur supprimé'], 200);
    }*/

    /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     summary="Supprimer un utilisateur",
     *     tags={"Utilisateurs"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'utilisateur",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Utilisateur supprimé avec succès",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Utilisateur supprimé")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Non autorisé",
    *         @OA\JsonContent(
    *             @OA\Property(property="message", type="string", example="Non autorisé")
    *         )
    *     ),
    *     @OA\Response(
    *         response=403,
    *         description="Accès interdit",
    *         @OA\JsonContent(
    *             @OA\Property(property="message", type="string", example="Non autorisé")
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Utilisateur non trouvé",
    *         @OA\JsonContent(
    *             @OA\Property(property="message", type="string", example="Utilisateur non trouvé")
    *         )
    *     )
    * )
    */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }

        if (auth()->id() !== $user->id) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $user->delete();

        return response()->json(['message' => 'Utilisateur supprimé'], 200);
    }

    /**
    * @OA\Post(
    *     path="/api/login",
    *     summary="Connexion d'un utilisateur",
    *     tags={"Auth"},
    *     @OA\Parameter(name="email", in="query", description="Email de l'utilisateur", required=true, @OA\Schema(type="string", format="email")),
    *     @OA\Parameter(name="password", in="query", description="Mot de passe de l'utilisateur", required=true, @OA\Schema(type="string", format="password")),
    *     @OA\Response(response=200, description="Connexion réussie, retourne un token"),
    *     @OA\Response(response=401, description="Non autorisé, email ou mot de passe incorrect"),
    *     @OA\Response(response=422, description="Erreur de validation")
    * )
    */
    public function login(Request $request){
        $credentials =$request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string',
        ]);
        

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        return response()->json(['token' => $token]);


        /*$user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Identifiants incorrects'], 401);
        }

        $token = $user->createToken($user->name);
        return response()->json([
            'user connecté' => $user,
            'token'=>$token->plainTextToken,
        ]);*/
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Déconnexion de l'utilisateur",
     *     tags={"Auth"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Déconnexion réussie",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Déconnexion réussie")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Token invalide ou expiré",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Non autorisé")
     *         )
     *     )
     * )
     */
    public function logout(/*Request $request*/)
    {
        //$request->user()->tokens()->delete();
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Déconnexion réussie'], 200);
    }
}

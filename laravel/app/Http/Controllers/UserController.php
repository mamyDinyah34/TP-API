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
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
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
             201
        ]);
    }

    /**
     * Display the specified resource.
     */
    /*public function show(User $user)
    {
        return response()->json($user, 200);
    }*/
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

    public function logout(/*Request $request*/)
    {
        //$request->user()->tokens()->delete();
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Déconnexion réussie'], 200);
    }
}

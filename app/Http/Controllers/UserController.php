<?php

namespace App\Http\Controllers;

use JWTAuth;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;


class UserController extends Controller
{

    /**
     * Create a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.jwt', ['except' => ['login']]);
        $this->middleware(['role:Administrador'], ['except' => [
            'login',
            'logout'
        ]]);
    }

    /**
     * create a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function newUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:Administrador,Personal',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->assignRole($request->role);

        $user['rol'] = $user->roles()->pluck('name')->implode(' ');

        return response()->json([
            'message' => 'Usuario creado exitosamente',
            'user' => $user
        ], 201);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'error' => 'Credenciales no válidas'
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'No se ha podido crear el token'
            ], 500);
        }
        $user = Auth::user();
        return response()->json([
            'status' => 'ok',
            'user' => $user,
            'role' => $user->roles()->pluck('name')->implode(' '),
            'token' => $token,
        ], 200);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser()
    {
        $user = auth('api')->user();
        return response()->json(['user' => $user], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'ok',
            'message' => 'Se ha cerrado la sesión con éxito',
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return response()->json([
            'status' => 'ok',
            'user' => Auth::user(),
            'authorisation' => [
                'type' => 'bearer',
            ],
            'token' => Auth::refresh()
        ]);
    }

    public function allUsers()
    {
        $allUsers = User::with('pregnants')->paginate(100);

        foreach ($allUsers as $user) {
            $user['rol'] = $user->roles()->pluck('name')->implode(' ');
        }
        
        return response()->json([
            'allUsers' => $allUsers,
        ]);
    }
}

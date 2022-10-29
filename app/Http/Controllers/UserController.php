<?php

namespace App\Http\Controllers;

use JWTAuth;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
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

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if (!$request->password == '') {
            $user->password = bcrypt($request->password);
        }

        $user->save();
 
        $user->syncRoles([]);
        $user->assignRole($request->role);
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return User::destroy($id);
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
            'id' => (string)$user->id,
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
            'id' => strval(Auth::user()->id),
            'token' => Auth::refresh()
        ]);
    }

    public function allUsers()
    {
        return UserResource::collection(User::paginate(100)->reverse());
    }
}

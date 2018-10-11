<?php

namespace App\Http\Controllers\Api;

use App\Http\Services\RedirectToken;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'signUp']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return  RedirectToken::respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return RedirectToken::respondWithToken(auth()->refresh());
    }

    /**
     * Get the Sign with token
     *
     * @param $token
     * @param Request $request
     */
    protected function signUp($token, Request $request)
    {
        try{
            $user = User::where('token', '=', $token)->first();

            $token_u = str_random(10);

            while (User::where('token', '=', $token_u)->first()) {
                $token_u = str_random(10);
            }

            $collaborate = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 0,
                'bids' => 0,
                'token' => $token_u
            ]);

            if ($user->isStudent) {
                $user->buyers()->save($collaborate);
            }

            throw new \Exception('Não foi possível vincular a um estudante');

        }catch (\Exception $e){
            return redirect()->json($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

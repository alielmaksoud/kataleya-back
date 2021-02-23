<?php

namespace App\Repositories;

use App\User;
use App\Cart;

use App\Response;

class UserRepository implements UserRepositoryInterface
{
    public function register($request)
    {
        $data = $request->all();
        $user = User::create([
        'name' => $data['name'],
        'email'=>$data['email'],
        'password'=>bcrypt($data['password']),
        'phone_number'=>$data['phone_number'],
         ]);
         
        if ($user) {
            $id= $user->id;
            $cart = Cart::create([
                'user_id' => $id,
            ]);
        }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login($request)
    {
        
        //return $this->createNewToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        $user=auth()->user();
        
        // return response()->json(auth()->user());
        return Response::success($user, "Admin profile");
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $user=auth()->logout();
        $message="Successfully logged out";

        //return response()->json(['message' => 'Successfully logged out']);
        return Response::success($user, $message);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createNewToken($token)
    {
    }
    public function displayOrder($orderId)
    {
        $user = User::with('orders')->findOrFail($orderId);
        return response()->json([
            'user' => $user
        ]);
    }
}
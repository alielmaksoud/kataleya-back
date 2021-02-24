<?php

namespace App\Repositories;

use App\User;
use App\Cart;

use App\Response;

class UserRepository implements UserRepositoryInterface
{
    public function display()
    {
        return $user = User::all();
    }

    public function view($id)
    {
        return User::where('id', $id)->first();

    }

    public function delete($id)
    {
        User::where('id', $id)->delete();
        return response()->json([
            'message' => 'User profile deleted'
        ]);
    }
    public function update($request, $id)
    {
        $data = $request->all();
        $user = Admin::where('id', $id)->first();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->phone = $data['phone'];
        $user->save();
    }




    public function register($request)
    {
        $data = $request->all();
        $user = User::create([
        'name' => $data['name'],
        'email'=>$data['email'],
        'password'=>bcrypt($data['password']),
        'phone'=>$data['phone'],
         ]);
         
         if($user){
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
}
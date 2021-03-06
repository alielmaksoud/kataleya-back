<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;
use App\Repositories\UserRepositoryInterface;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;

use App\Response;
use App\User;

class JWTAuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository =$userRepository;
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function verifytokens()
    {
        return response()->json(['message' => 'Verified']);
    }



    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
    public function index()
    {
        $user=$this->userRepository->display();
        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=$this->userRepository->view($id);
        return response()->json($user);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $user=$this->userRepository->delete($id);
        return response()->json([
            'message' => ' User deleted'
        ]);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRegisterRequest $request)
    {
        $validator=$request->validated();
        
        if ($validator) {
            $user=$this->userRepository->register($request);
            return Response::success($user, "User succesfully registered!");
        }
        return Response::error(401, "Invalid info, couldn't Register");
    }

     

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(UserLoginRequest $request)
    {
        $validator=$request->validated();

        if (!$validator) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return $this->userRepository->profile();
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
        $request->validate([

            'password' => 'min:6',
            'phone' => ['required', 'regex:/^((961[\s+-]*(3|7(0|1)))|(03|7(0|1))|(81|7(6|8))|(79))[\s+-]*\d{6}$/u'],
         
        ]);

        $data = $request->all();
        
        $user = User::where('id', $id)->first();
        if (!empty($request['password']) && $request['password'] !== "undefined") {
            $user->password = $request['password'];
        }
        if (!empty($request['name']) && $request['name'] !== "undefined") {
            $user->name = $request['name'];
        }
        if (!empty($request['email']) && $request['email'] !== "undefined") {
            $user->email = $request['email'];
        }
        if (!empty($request['phone']) && $request['phone'] !== "undefined") {
            $user->phone = $request['phone'];
        }
        $user->save();
        
        return response()->json([
            'status' => 200,
            'admin'  => $user
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        return $user=$this->userRepository->logout();
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
    public function displayOrder($orderId)
    {
        return $user=$this->userRepository->displayOrder($orderId);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
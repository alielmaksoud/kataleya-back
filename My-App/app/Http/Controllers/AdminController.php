<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;

use App\Repositories\AdminRepository;
use App\Http\Requests\AdminRegisterRequest;
use App\Http\Requests\AdminLoginRequest;
use App\Response;
use App\Admin;

class AdminController extends Controller
{
    

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository =$adminRepository;
        $this->middleware('auth:admin', ['except' => ['login', 'register']]);
    }

   

    /**
     * Register a admin.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(AdminRegisterRequest $request)
    /* {
        $validator=$request->validated();
        
        if ($validator) {
            $admin=$this->adminRepository->register($request);
            return Response::success($admin, "Admin succesfully registered!");
        }
        return Response::error(401, "Invalid info, couldn't Register");
    } */
    {
    $validator=$request->validated();

    if ($validator) {

        $admin=$this->adminRepository->register($request);
        return response()->json([
            'admin'  => $admin,
            "message" =>"Admin succefully registered"
        ],200);
    }
    return response()->json([
        "message" =>"Invalid info, couldn't Register"
    ],401);
    }
     

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AdminLoginRequest $request)
    {
        $validator=$request->validated();

        if (!$validator) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator)) {
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
        return $this->adminRepository->profile();
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        return $admin=$this->adminRepository->logout();
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
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
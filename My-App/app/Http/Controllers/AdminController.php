<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;

use App\Repositories\AdminRepository;
use App\Repositories\UserRepository;
use App\Http\Requests\AdminRegisterRequest;
use App\Http\Requests\AdminLoginRequest;
use App\Response;
use App\Admin;
use App\User;


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


   /////// user

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexuser()
    {
        return User::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showuser($id)
    {
        return User::where('id', $id)->first();
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyuser($id)
    {
        User::where('id', $id)->delete();

        return User::all();
    }

    public function updateuser(Request $request, $id)
    {
        $request->validate([

            'password' => 'min:6',
            'phone' => ['required', 'regex:/^((961[\s-]*(3|7(0|1)))|([\s+]961[\s-]*(3|7(0|1)))|(03|7(0|1)))[\s+-]*\d{6}$/u'],
         
        ]);

        $data = $request->all();
        
        $user = User::where('id', $id)->first();
        if(!empty($request['password']) && $request['password'] !== "undefined"){
            $user->password = $request['password'];
        }if(!empty($request['name']) && $request['name'] !== "undefined"){
            $user->name = $request['name'];
        }if(!empty($request['email']) && $request['email'] !== "undefined"){
            $user->email = $request['email'];
        }if(!empty($request['phone']) && $request['phone'] !== "undefined"){
            $user->phone = $request['phone'];
            
        }
        $user->save();
        
        return response()->json([
            'status' => 200,
            'admin'  => $user
        ]);
    }



    //////// admin


   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin=$this->adminRepository->display();
        return response()->json($admin);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin=$this->adminRepository->view($id);
        return response()->json($admin);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin=$this->adminRepository->delete($id);
        return response()->json([
            'message' => ' Admin deleted'
        ]);
    }



    /**
     * Register a admin.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(AdminRegisterRequest $request)
    
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRegisterRequest $request, $id)
    {
        $validator=$request->validated();


        if ($validator) {
            $admin=$this->adminRepository->update($request, $id);
            

            return response()->json(['status' => 200, 'admin' => $admin]);
        }
    }



   /*  public function update(Request $request, $id)
    {
        $request->validate([
            'password' => 'min:6',
            'phone' => ['required', 'regex:/^((961[\s-]*(3|7(0|1)))|([\s+]961[\s-]*(3|7(0|1)))|(03|7(0|1)))[\s+-]*\d{6}$/u'],
         
        ]);

        $data = $request->all();
        
        $admin = Admin::where('id', $id)->first();
        if(!empty($request['password']) && $request['password'] !== "undefined"){
            $admin->password = $request['password'];
        }if(!empty($request['name']) && $request['name'] !== "undefined"){
            $admin->name = $request['name'];
        }if(!empty($request['email']) && $request['email'] !== "undefined"){
            $admin->email = $request['email'];
            
        }
        $admin->save();
        
        return response()->json([
            'status' => 200,
            'admin'  => $user
        ]);
    }
 */
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

    public function verifytokens()
    {
        return response()->json(['message' => 'Verified']);
    }

    
}
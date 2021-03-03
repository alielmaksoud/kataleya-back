<?php

namespace App\Http\Controllers;

use App\UsdRate;
use Illuminate\Http\Request;
use App\Http\Requests\UsdRateRequest;
use App\Repositories\UsdRateRepository;
use JWTAuth;

class UsdRateController extends Controller
{
    protected $usdRate;
    protected $usdRateRepository;

    public function __construct(UsdRateRepository $usdRateRepository)
    {
        config()->set( 'auth.defaults.guard', 'admin' );
        $this->usdRateRepository =$usdRateRepository;
        $this->user = JWTAuth::parseToken()->authenticate();
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UsdRate  $usdRate
     * @return \Illuminate\Http\Response
     */
    public function show(UsdRate $usdRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UsdRate  $usdRate
     * @return \Illuminate\Http\Response
     */
    public function edit(UsdRate $usdRate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UsdRate  $usdRate
     * @return \Illuminate\Http\Response
     */
    public function update(UsdRateRequest $request, $id)
    {
       
        // $usdRate=$this->usdRateRepository->update($request, 1);
        // return response()->json(['status' => 200, 'usdRate' => $usdRate]);
        $usdRate=$this->usdRateRepository->update($request, $id);
        $rate = UsdRate::all();
        return response()->json(['status' => 200, 'usdRate' => $rate]);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UsdRate  $usdRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsdRate $usdRate)
    {
        //
    }
}

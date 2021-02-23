<?php

namespace App\Http\Controllers;

use App\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\FeatureRequest;
use App\Repositories\FeatureRepository;

use JWTAuth;

class FeatureController extends Controller
{
    /* protected $admin; */
    protected $FeatureRepository;

    public function __construct(FeatureRepository $featureRepository)
    {
        $this->featureRepository =$featureRepository;
        /* $this->admin = JWTAuth::parseToken()->authenticate(); */
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $features=$this->featureRepository->display();
        return response()->json($features);
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
    public function store(FeatureRequest $request)
    {
        $validator=$request->validated();

        if ($validator) {
            $feature=$this->featureRepository->create($request);

            return response()->json([
                    'message' => 'feature Added',
                    'feature' => $feature
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $feature=$this->featureRepository->view($id);
        return response()->json($feature);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FeatureRequest $request, $id)
    {
        $validator=$request->validated();


        if ($validator) {
            $feature=$this->featureRepository->update($request, $id);
            

            return response()->json(['status' => 200, 'features' => $feature]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feature=$this->featureRepository->delete($id);
        return response()->json([
            'message' => ' feature deleted'
        ]);
    }
}
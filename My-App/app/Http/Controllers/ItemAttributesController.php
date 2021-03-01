<?php

namespace App\Http\Controllers;

use App\ItemAttributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ItemAttributesRequest;
use App\Repositories\ItemAttributesRepository;

use JWTAuth;

class ItemAttributesController extends Controller
{
    protected $user;
    protected $itemAttributesRepository;

    public function __construct(ItemAttributeRepository $itemAttributeRepository)
    {
        config()->set( 'auth.defaults.guard', 'admin' );
        $this->itemAttributeRepository =$itemAttributeRepository;
        $this->user = JWTAuth::parseToken()->authenticate();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemAttributes=$this->itemAttributeRepository->display();
        return response()->json($itemAttributes);
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
    public function store(ItemAttributeRequest $request)
    {
        // $validator=$request->validated();

        // if ($validator) {
            $itemAttribute=$this->itemAttributeRepository->create($request);

        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $itemAttribute=$this->itemAttributeRepository->view($id);
        return response()->json($itemAttribute);
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
    public function update(ItemAttributeRequest $request, $id)
    {
        $validator=$request->validated();


        if ($validator) {
            $itemAttribute=$this->itemAttributeRepository->update($request, $id);


            return response()->json(['status' => 200, 'itemAttribute' => $itemAttribute]);
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
        $item=$this->itemRepository->delete($id);
        return response()->json([
            'message' => ' Item deleted'
        ]);
    }
}
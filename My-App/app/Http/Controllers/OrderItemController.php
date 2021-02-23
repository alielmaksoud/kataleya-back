<?php

namespace App\Http\Controllers;

use App\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\OrderItemRequest;
use App\Repositories\OrderItemRepository;

use JWTAuth;

class OrderItemController extends Controller
{
    protected $user;
    protected $orderItemRepository;

    public function __construct(OrderItemRepository $orderItemRepository)
    {
        $this->orderItemRepository =$orderItemRepository;
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderItems=$this->orderItemRepository->display();
        return response()->json($orderItems);
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
    public function store(OrderItemRequest $request)
    {
        $validator=$request->validated();

        if ($validator) {
            $orderItem=$this->orderItemRepository->create($request);

            return response()->json([
                    'message' => 'Category Added',
                    'category' => $orderItem
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
        $orderItem=$this->orderItemRepository->view($id);
        return response()->json($orderItem);
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
    public function update(OrderItemRequest $request, $id)
    {
        $validator=$request->validated();


        if ($validator) {
            $orderItem=$this->orderItemRepository->update($request, $id);
            

            return response()->json(['status' => 200, 'orderItem' => $orderItem]);
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
        $orderItem=$this->orderItemRepository->delete($id);
        return response()->json([
            'message' => 'Order Item deleted'
        ]);
    }
}
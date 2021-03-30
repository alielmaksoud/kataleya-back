<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Validator;
use App\Repositories\OrderRepositoryInterface;
use App\Response;
use App\Http\Requests\OrderRequest;
use JWTAuth;

class OrderController extends Controller
{
    protected $user;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository =$orderRepository;
        //config()->set('auth.defaults.guard', 'api');
        //  $this->user = JWTAuth::parseToken()->authenticate();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=$this->orderRepository->display();
        return response()->json($orders);
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
    public function store(OrderRequest $request)
    {
        $validator=$request->validated();
       
        if ($validator) {
            $order=$this->orderRepository->create($request);
            $id = auth()->user()->id;
            $data = Order::find(\DB::table('orders')->where('user_id', $id)->max('id'));
            return Response::success($data, "Order Added");
        }
        return Response::error(401, "Order Not Added", "Invalid Data");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=$this->orderRepository->view($id);
        return response()->json($order);
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
    public function update(OrderRequest $request, $id)
    {
        $validator=$request->validated();

        if ($validator) {
            $order=$this->orderRepository->update($request, $id);
            $data=$request->all();
            return response()->json(['status' => 200, 'order' => $data]);
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
        $order=$this->orderRepository->delete($id);
        return response()->json([
            'message' => 'order deleted'
        ]);
    }
    public function retrieve($id)
    {
        $users=$this->orderRepository->retrieve($id);
        return response()->json($users);
    }
}
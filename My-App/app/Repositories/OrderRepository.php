<?php

namespace App\Repositories;

use App\Order;

class OrderRepository implements OrderRepositoryInterface
{
    public function display()
    {
        $id = auth()->user()->id;
        return $orders = Order::where('user_id', $id)->get();
    }
 
    public function view($id)
    {
        return Order::where('id', $id)->first();
    }
 
    public function create($request)
    {
        // $data = $request->all();
        // /* $date = date_default_timezone_get(); */
        // $id = auth()->user()->id;
            
        // $order = Order::create([
        //             'overall_price' => $data['overall_price'],
        //             'order_date'=>$data['order_date'],
        //             'shipped_date'=>$data['shipped_date'],
        //             // 'user_id'=>$data['user_id'],
        //             'user_id'=>$id,
        //             'status_id'=>$data['status_id'],
        //             'address'=>$data['address'],
        //         ]);
        $message = new Order();
        $message -> fill($request->all());
        if ($message->save()) {
            return response()->json([
                'data' => $message
            ], 200);
        }
        return response()->json([
            'message' => 'message could not be added'
        ], 500);
    }
    public function update($request, $id)
    {
        $data = $request->all();
        $Uid = auth()->user()->id;
        $order = Order::where('id', $id)->first();
        $order->overall_price = $data['overall_price'];
        $order->order_date = $data['order_date'];
        $order->shipped_date=$data['shipped_date'];
        $order->user_id=$Uid;
        $order->address=$data['address'];
        $order->save();
    }
    public function delete($id)
    {
        Order::where('id', $id)->delete();
    }
}
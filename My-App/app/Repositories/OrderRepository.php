<?php

namespace App\Repositories;

use App\Order;

class OrderRepository implements OrderRepositoryInterface
{
    public function display()
    {
        $id = auth()->user()->id;
        return $orders = Order::where('user_id',$id)->get();
    }
 
    public function view($id)
    {
        return Order::where('id', $id)->first();
    }
 
    public function create($request)
    {
        $data = $request->all();
        /* $date = date_default_timezone_get(); */
        $id = auth()->user()->id;
            
        $order = Order::create([
                    'overall_price' => $data['overall_price'],
                    'order_date'=>$data['order_date'],
                    'shipped_date'=>$data['shipped_date'],
                    // 'user_id'=>$data['user_id'],
                    'user_id'=>$id,
                    'address'=>$data['address'],
                ]);
        
    }
    public function update($request, $id)
    {
        $data = $request->all();
        $order = Order::where('id', $id)->first();
        $order->overall_price = $data['overall_price'];
        $order->order_date = $data['order_date'];
        $order->shipped_date=$data['shipped_date'];
        $order->user_id=$data['user_id'];
        $order->address=$data['address'];
        $order->save();
    }
    public function delete($id)
    {
        Order::where('id', $id)->delete();
    }
}
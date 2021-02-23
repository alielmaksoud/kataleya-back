<?php

namespace App\Repositories;

use App\OrderItem;

class OrderItemRepository implements OrderItemRepositoryInterface
{
    public function display()
    {
        return $orderItems = OrderItem::all();
    }
 
    public function view($id)
    {
        return OrderItem::where('id', $id)->first();

    }
 
    public function create($request)
    {
        $data = $request->all();
            
            
        $category = OrderItem::create([
                // 'item'=>$data['item'],
                'quantity' => $data['quantity'],
                'price'=>$data['price'],
                'item_id' => $data['item_id'],
                'order_id'=>$data['order_id'],
            ]);
    }
    public function update($request, $id)
    {
        $data = $request->all();
        $category = OrderItem::where('id', $id)->first();
        // $category->item = $data['item'];
        $category->quantity = $data['quantity'];
        $category->price = $data['price'];
        $category->item_id = $data['item_id'];
        $category->order_id = $data['order_id'];
        $category->save();
    }
    public function delete($id)
    {
        OrderItem::where('id', $id)->delete();

    }
}
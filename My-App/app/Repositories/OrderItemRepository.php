<?php

namespace App\Repositories;

use App\OrderItem;
use App\CartItem;

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
        $data=$request->all();
        $items=CartItem::all();
        foreach ($items as $item) {
            OrderItem::create([
                'quantity' => $data['quantity'],
                "image"=>$item['image'],
                'name'=>$item['name'],
                'bottle_size'=>$item['bottle_size'],
                'price'=>$data['price'],
                'item_id' => $item['item_id'],
                'order_id'=>$item['cart_id'],
            ]);
        }
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
<?php

namespace App\Repositories;

use App\CartItem;

class CartItemRepository implements CartItemRepositoryInterface
{
    public function display()
    {
        return $cartItems = CartItem::all();
    }
 
    public function view($id)
    {
        return CartItem::where('id', $id)->first();

    }
 
    public function create($request)
    {
        $data = $request->all();
            
            
        $category = CartItem::create([
                'date_added'=>$data['date_added'],
                'quantity' => $data['quantity'],
                'item_id' => $data['item_id'],
                'cart_id'=>$data['cart_id'],
            ]);
    }
    public function update($request, $id)
    {
        $data = $request->all();
        $category = CartItem::where('id', $id)->first();
        $category->item = $data['item'];
        $category->quantity = $data['quantity'];
        $category->price = $data['price'];
        $category->item_id = $data['item_id'];
        $category->cart_id = $data['cart_id'];
        $category->save();
    }
    public function delete($id)
    {
        CartItem::where('id', $id)->delete();

    }
}
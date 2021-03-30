<?php

namespace App\Repositories;

use App\CartItem;
use App\Cart;
use App\UsdRate;
use App\ItemAttributes;
use App\Http\Controllers\Auth;
use DB;

class CartItemRepository implements CartItemRepositoryInterface
{
    public function display()
    {
        $items=CartItem::all();
       
        return $items;
    }
 
    public function view($id)
    {
        return CartItem::where('id', $id)->first();
    }
 
    public function create($request)
    {
        $data = $request->all();
        $category = CartItem::create([
                 'price'=>$data['price'],
                 'bottle_size'=>$data['bottle_size'],
                 'name'=>$data['name'],
                 'image'=>$data['image'],
                'item_id' => $data['item_id'],
                'cart_id'=>$data['cart_id'],
                
            ]);
    }
    public function update($request, $id)
    {
        $data = $request->all();

        $rates=UsdRate::all();
        $rate=$rates['rate'];
        $items=ItemAttributes::select('offer_price', 'price')->where('item_id', $data['item_id'])->where('bottle_size', $data['bottle_size'])->get();
        foreach ($items as $e) {
            if ($e['offer_price']>0) {
                $price=$e['offer_price']*$data['quantity']*$rates;
            } else {
                $price=$e['price']*$data['quantity']*$rate['rate'];
            }
        }
        $item = CartItem::where('id', $id)->first();
        $item->quantity = $data['quantity'];
        $item->cart_id = $data['cart_id'];
        $item->item_id = $data['item_id'];
        $item->price=$price;
        $item->save();
    }
    public function delete($id)
    {
        CartItem::where('id', $id)->delete();
    }
    public function erase()
    {
        Item::truncate();
        return response()->json([
            'message' => 'item deleted'
        ]);
    }
}
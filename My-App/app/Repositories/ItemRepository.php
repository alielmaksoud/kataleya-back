<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;

use App\Item;

class ItemRepository implements ItemRepositoryInterface
{
    
    public function display()
    {
        return $orderItems = Item::all();
    }
 
    public function view($id)
    {
        return Item::where('id', $id)->first();

    }
 
    public function create($request)
    {
        $data = $request->all();
        $image = $request->file('image');
        $path = Storage::disk('public')->put('images', $image);
        if($path){
            $item = Item::create([
                'name'=>$data['name'],
                'description' => $data['description'],
                'image'=>$path,
                'price' => $data['price'],
                'bottle_size' => $data['bottle_size'],
                'is_offer'=>$data['is_offer'],
                'offer_price' => $data['offer_price'],
                'is_featured'=>$data['is_featured'],
                'category_id'=>$data['category_id'],
            ]);
            return response()->json([
                'message' => 'Item Added',
                'item' => $item
            ]);
        }else {
            return response()->json(['staus' => 500, 'error' => "couldnt upload image"]);
        }
    }
    public function update($request, $id)
    {
        $data = $request->all();
        $image = $request->file('image');
        $path = Storage::disk('public')->put('images', $image);
        if($path){

        $item =Item::where('id', $id)->first();
        $item->name = $data['name'];
        $item->description = $data['description'];
        $item->image = $path['image'];
        $item->price = $data['price'];
        $item->bottle_size = $data['bottle_size'];
        $item->is_offer = $data['is_offer'];
        $item->offer_price = $data['offer_price'];
        $item->is_featured = $data['is_featured'];
        $item->category_id = $data['category_id'];
        $item->save();
        return response()->json(['status' => 200, 'item' => $item]);

        }
        else {

            return response()->json(['staus' => 500, 'error' => "couldnt upload image"]);
        }
    }
    public function delete($id)
    {
        Item::where('id', $id)->delete();
        return response()->json([
            'message' => 'item profile deleted'
        ]);
    }
}
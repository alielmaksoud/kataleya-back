<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;

use App\Item;
use App\UsdRate;
use App\ItemAttributes;

class ItemRepository implements ItemRepositoryInterface
{
    public function display()
    {
        $items = Item::join('categories', 'categories.id', 'items.category_id')
        ->select('items.*', 'categories.category_name')
        ->with('itemAttributes')
        ->get();
        $rate = UsdRate::Where('id', '1')->get('rate');
        $data = [$items, $rate];
        return $data;
    }

    public function view($id)
    {
        $data = Item::with('item_attributes')->where('id', $id)->first();
        $rate = UsdRate::Where('id', '1')->get('rate');
        array_push($data, $rate);
        return $data;
    }

    public function create($request)
    {
        $data = $request->all();
        $image = $request->file('image');
        $path = Storage::disk('public')->put('images', $image);
        if ($path) {
            $item = Item::create([
                'name'=>$data['name'],
                'description' => $data['description'],
                'image'=>$path,
                 'is_offer'=>$data['is_offer'],
                 'is_featured'=>$data['is_featured'],
                'category_id'=>$data['category_id'],
            ]);
            
            
            $keys = array_keys($data);
            $unWantedKeys = ['name', 'description', 'image', 'is_offer', 'is_featured', 'category_id'];
            foreach ($keys as $element) {
                if (in_array($element, $unWantedKeys)) {
                    unset($data[$element]);
                }
            }
            $numAttributes = count($data) / 3;

            for ($i = 0; $i < $numAttributes; $i++) {
                ${"attr_".$i} = [];
            }

            foreach ($data as $key => $value) {
                switch ($key) {
                    case (preg_match('/_0.*/', $key) ? true : false):
                        $attr_0 += array($key=>$value);
                        break;
                    case (preg_match('/_1.*/', $key) ? true : false):
                        $attr_1 += array($key=>$value);
                        break;
                    case (preg_match('/_2.*/', $key) ? true : false):
                        $attr_2 += array($key=>$value);
                        break;
                    case (preg_match('/_3.*/', $key) ? true : false):
                        $attr_3 += array($key=>$value);
                        break;
                    case (preg_match('/_4.*/', $key) ? true : false):
                        $attr_4 += array($key=>$value);
                        break;
                    case (preg_match('/_5.*/', $key) ? true : false):
                        $attr_5 += array($key=>$value);
                        break;
                    case (preg_match('/_6.*/', $key) ? true : false):
                        $attr_6 += array($key=>$value);
                        break;
                    case (preg_match('/_7.*/', $key) ? true : false):
                        $attr_7 += array($key=>$value);
                        break;
                    case (preg_match('/_8.*/', $key) ? true : false):
                        $attr_8 += array($key=>$value);
                        break;
                    case (preg_match('/_9.*/', $key) ? true : false):
                        $attr_9 += array($key=>$value);
                        break;
                    case (preg_match('/_10.*/', $key) ? true : false):
                        $attr_10 += array($key=>$value);
                        break;
                }
            }
            $item_id = Item::max('id');
            for ($i = 0; $i < $numAttributes; $i++) {
                $itemAttributes = ItemAttributes::create([
                    'price' => (${"attr_".$i}['price_'.$i]),
                    'offer_price' => (${"attr_".$i}['offer_price_'.$i]),
                    'bottle_size' => (${"attr_".$i}['bottle_size_'.$i]),
                    'item_id' => $item_id,
                ]);
            }
        
            return response()->json([
                'message' => 'Item and attributes Added',
                'item' => $item
            ]);
        } else {
            return response()->json(['status' => 500, 'error' => "couldnt upload image"]);
        }
    }
    public function update($request, $id)
    {
        $data = $request->all();
        $image = $request->file('image');
        $path = Storage::disk('public')->put('images', $image);
        if ($path) {
            $item =Item::where('id', $id)->first();
            $item->name = $data['name'];
            $item->description = $data['description'];
            $item->image = $path;
            $item->is_offer = $data['is_offer'];
            $item->is_featured = $data['is_featured'];
            $item->category_id = $data['category_id'];
            $item->save();


            $keys = array_keys($data);
            $unWantedKeys = ['name', 'description', 'image', 'is_offer', 'is_featured', 'category_id','_method'];
            foreach ($keys as $element) {
                if (in_array($element, $unWantedKeys)) {
                    unset($data[$element]);
                }
            }
            $numAttributes = count($data) / 3;
        
            for ($i = 0; $i < $numAttributes; $i++) {
                ${"attr_".$i} = [];
            }

            foreach ($data as $key => $value) {
                switch ($key) {
                case (preg_match('/_0.*/', $key) ? true : false):
                    $attr_0 += array($key=>$value);
                    break;
                case (preg_match('/_1.*/', $key) ? true : false):
                    $attr_1 += array($key=>$value);
                    break;
                case (preg_match('/_2.*/', $key) ? true : false):
                    $attr_2 += array($key=>$value);
                    break;
                case (preg_match('/_3.*/', $key) ? true : false):
                    $attr_3 += array($key=>$value);
                    break;
                case (preg_match('/_4.*/', $key) ? true : false):
                    $attr_4 += array($key=>$value);
                    break;
                case (preg_match('/_5.*/', $key) ? true : false):
                    $attr_5 += array($key=>$value);
                    break;
                case (preg_match('/_6.*/', $key) ? true : false):
                    $attr_6 += array($key=>$value);
                    break;
                case (preg_match('/_7.*/', $key) ? true : false):
                    $attr_7 += array($key=>$value);
                    break;
                case (preg_match('/_8.*/', $key) ? true : false):
                    $attr_8 += array($key=>$value);
                    break;
                case (preg_match('/_9.*/', $key) ? true : false):
                    $attr_9 += array($key=>$value);
                    break;
                case (preg_match('/_10.*/', $key) ? true : false):
                    $attr_10 += array($key=>$value);
                    break;
            }
            }
       
       


            $itemAttributes = ItemAttributes::where('item_id', $id)->get();
            if ($numAttributes > count($itemAttributes)) {
                for ($i = 0; $i < count($itemAttributes); $i++) {
                    $itemAttributes[$i]->price = (${"attr_".$i}['price_'.$i]);
                    $itemAttributes[$i]->offer_price =(${"attr_".$i}['offer_price_'.$i]);
                    $itemAttributes[$i]->bottle_size =(${"attr_".$i}['bottle_size_'.$i]);
                    $itemAttributes[$i]->item_id = $id;
                    $item->save();
                }
                for ($i = count($itemAttributes); $i < $numAttributes; $i++) {
                    $itemAttributes = ItemAttributes::create([
                        'price' => (${"attr_".$i}['price_'.$i]),
                        'offer_price' => (${"attr_".$i}['offer_price_'.$i]),
                        'bottle_size' => (${"attr_".$i}['bottle_size_'.$i]),
                        'item_id' => $id,
                    ]);
                }
            } else {
                for ($i = 0; $i < $numAttributes; $i++) {
                    $itemAttributes = ItemAttributes::create([
                        'price' => (${"attr_".$i}['price_'.$i]),
                        'offer_price' => (${"attr_".$i}['offer_price_'.$i]),
                        'bottle_size' => (${"attr_".$i}['bottle_size_'.$i]),
                        'item_id' => $id,
                    ]);
                }
            }
            
            return response()->json(['status' => 200, 'item' => $item]);
        } else {
            return response()->json(['staus' => 500, 'error' => "couldnt upload image"]);
        }
    }
    public function delete($id)
    {
        Item::where('id', $id)->delete();
        return response()->json([
            'message' => 'item deleted'
        ]);
    }
}
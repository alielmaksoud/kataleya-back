<?php

namespace App\Repositories;

use App\Feature;

class FeatureRepository implements FeatureRepositoryInterface
{
    
    public function display()
    {
        $feature = Feature::all();
        if ($feature){
            return response()-> json([
                'data'=> $feature
            ],200);
        }
        return response()->json([
            'message' => 'feature not found',
        ], 404);
       
    }
 
    public function view($id)
    {
        $feature= Feature::find($id);
        if ($feature)
        {
            return response ()->json([
                'data'=>$feature
            ],200);
        }
        return response()->json([
            'message' => 'feature could not be found'
        ],500);
    }
 
    public function create($request)
    {
        $data = $request->all();
        $image = $request->file('image');
        $path = Storage::disk('public')->put('images', $image);
        if($path){
            $feature = Feature::create([
                'name'=>$data['name'],
                'description' => $data['description'],
                'image'=>$path['image'],
                'price' => $data['price'],
                'bottle_size' => $data['bottle_size'],
    
                'gender_id'=>$data['gender_id'],
            ]);
            return response()->json([
                'message' => 'feature Added',
                'feature' => $feature
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

        $feature =Feature::where('id', $id)->first();
        $feature->name = $data['name'];
        $feature->description = $data['description'];
        $feature->image = $path['image'];
        $feature->price = $data['price'];
        $feature->bottle_size = $data['bottle_size'];

        $feature->gender_id = $data['gender_id'];
        $feature->save();
        return response()->json(['status' => 200, 'feature' => $feature]);

        }
        else {

            return response()->json(['staus' => 500, 'error' => "couldnt upload image"]);
        }
    }
    public function delete($id)
    {
        Feature::where('id', $id)->delete();
        return response()->json([
            'message' => 'feature profile deleted'
        ]);
    }
}
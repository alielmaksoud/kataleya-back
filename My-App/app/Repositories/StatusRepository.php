<?php

namespace App\Repositories;

use App\Status;

class StatusRepository implements StatusRepositoryInterface
{
    public function display()
    {
        return $status = Status::all();
    }
 
    public function view($id)
    {
        return Status::where('id', $id)->first();
    }
 
    public function create($request)
    {
        $data = $request->all();
        
        $id = auth()->user()->id;
        $Status = Status::create([
                'status'=>$data['status'],
                'order_id'=>$id,
               
               
            ]);
        return response()->json([
                'message' => 'Status Added',
                'Status' => $Status
            ]);
    }
    public function update($request, $id)
    {
        $data = $request->all();
        $Uid = auth()->user()->id;
        $Status =Status::where('id', $id)->first();
        $Status->status = $data['status'];
        $Status->order_id = $Uid;
            
        $Status->save();
        return response()->json(['status' => 200, 'item' => $item]);
    }
    public function delete($id)
    {
        Status::where('id', $id)->delete();
    }
}
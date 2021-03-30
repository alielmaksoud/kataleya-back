<?php

namespace App\Repositories;

use App\UsdRate;

class UsdRateRepository implements UsdRateRepositoryInterface
{
    public function update($request, $id)
    {
        $data = $request->all();
        // $usdRate = UsdRate::where('id', 1)->first();
        $usdRate = UsdRate::where('id', $id)->first();
        $usdRate->rate = $data['rate'];
        $usdRate->save();
    }
}
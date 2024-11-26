<?php

namespace App\Services;

use App\Http\Requests\CalculateTariffRequest;
use App\Http\Requests\TariffRequest;
use App\Http\Requests\TariffUpdateRequest;
use App\Models\Tariff;

class TariffService
{
    public function index()
    {
        return Tariff::query()
            ->paginate(10);
    }

    public function store(TariffRequest $request)
    {
        return Tariff::query()
            ->create([
                         'name'                 => $request->name,
                         'price'                => $request->price,
                         'delivery_time'        => $request->delivery_time,
                         'free_min_total_price' => $request->free_min_total_price,
                     ]);
    }

    public function edit($id)
    {
        return Tariff::findOrFail($id);
    }

    public function update(TariffUpdateRequest $request, $id)
    {
        return Tariff::query()
            ->findOrFail($id)
            ->update([
                         'name'                 => $request->name,
                         'price'                => $request->price,
                         'delivery_time'        => $request->delivery_time,
                         'free_min_total_price' => $request->free_min_total_price,
                     ]);
    }

    public function destroy($id)
    {
        return Tariff::query()
            ->findOrFail($id)
            ->delete();
    }

}

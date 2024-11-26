<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalculateTariffRequest;
use App\Http\Requests\TariffRequest;
use App\Http\Requests\TariffUpdateRequest;
use App\Models\Tariff;
use App\Services\TariffService;

class TariffController extends Controller
{
    public function __construct(

        protected TariffService $service
    ) {
    }

    public function index()
    {
        $tariffs = $this->service->index();

        return view('admin.tariff.index',
                    compact('tariffs'));
    }

    public function create()
    {
        return view('admin.tariff.create');
    }

    public function store(TariffRequest $request)
    {
        $this->service->store($request);

        return redirect()->route('tariff.index');
    }

    public function edit($id)
    {
        $tariff = $this->service->edit($id);

        return view('admin.tariff.edit',
                    compact(['tariff'])
        );
    }

    public function update(TariffUpdateRequest $request, $id)
    {
        $this->service->update($request, $id);

        return redirect()->route('tariff.index');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);

        return redirect()->route('tariff.index');
    }
}

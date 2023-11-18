<?php

namespace App\Http\Controllers\Package;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Models\Currency;
use App\Traits\HttpResponse;

class CurrencyController extends Controller
{
    use HttpResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = Currency::get();
        return $this->success([
            'currencies' => $currencies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCurrencyRequest $request)
    {
        $request->validated($request->all());
        $currency = Currency::create(array_merge_recursive($request->only('name', 'code', 'symbol', 'rate')));
        return $this->success([
            'currency' => $currency,
        ], 'Currency added auccessfull');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Currency $currency)
    {
        return $this->success([
            'currency' => $currency,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCurrencyRequest $request, Currency $currency)
    {
        $currency->update(array_merge_recursive($request->only('name', 'code', 'symbol', 'rate')));
        return $this->success([
            'data' => 'updated',
        ], 'Currency updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();
        return $this->success([
            'data' => 'deleted',
        ], 'Currency deleted successfull');
    }
}

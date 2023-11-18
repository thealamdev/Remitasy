<?php

namespace App\Http\Handlers\Package;

use App\Models\Currency;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;

class CurrencyHandler
{
    use HttpResponse;
    public function store(Request $request)
    {
        $currency = Currency::create(array_merge_recursive($request->only('name', 'code', 'symbol', 'rate')));
        return $this->success([
            'currency' => $currency,
        ], 'Currency added auccessfull');
    }

    public function update(Request $request, $currency)
    {
        $currency->update(array_merge_recursive($request->only('name', 'code', 'symbol', 'rate')));
        return $this->success([
            'data' => 'updated',
        ], 'Currency updated successfully');
    }
}

<?php

namespace App\Http\Controllers\Auth\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\MerchantLoginRequest;
use App\Http\Requests\MerchantRegisterRequest;
use App\Models\Merchant;
use App\Traits\HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticatinController extends Controller
{
    use HttpResponse;
    /**
     * Register into merchant account.
     */
    public function register(MerchantRegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $merchant = Merchant::create($data);

        return $this->success([
            'merchant' => $merchant,
            'token' => $merchant->createToken('API Token of ' . $merchant->full_name)->plainTextToken,
        ]);
    }

    /**
     * Show the form for login into merchant dashboard.
     */
    public function login(MerchantLoginRequest $request)
    {
        $request->validated($request->all());
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->error('', 'Credentials do not match admin', 401);
        }

        $merchant = Merchant::where('email', $request->email)->first();
        return $this->success([
            'merchant' => $merchant,
            'token' => $merchant->createToken('API Token of' . $merchant->full_name)->plainTextToken,
        ]);

    }

}

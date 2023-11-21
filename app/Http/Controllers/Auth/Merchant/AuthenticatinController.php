<?php

namespace App\Http\Controllers\Auth\Merchant;

use App\Enums\Bucket;
use App\Models\Merchant;
use App\Traits\Uploader;
use App\Traits\HttpResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\MerchantLoginRequest;
use App\Http\Requests\MerchantRegisterRequest;

class AuthenticatinController extends Controller
{
    use HttpResponse, Uploader;
    /**
     * Register into merchant account.
     */
    public function register(MerchantRegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $merchant = Merchant::create($data);
        $this->upload($request, 'image', $merchant->getKey(), Bucket::MERCHANT,Merchant::class);
        $this->upload($request,'document', $merchant->getKey(), Bucket::DOCUMENT,Merchant::class);

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
        if (!Auth::guard('merchant')->attempt($request->only(['email', 'password']))) {
            return $this->error('', 'Credentials do not match admin', 401);
        }

        $merchant = Merchant::where('email', $request->email)->first();
        return $this->success([
            'merchant' => $merchant,
            'token' => $merchant->createToken('API Token of' . $merchant->full_name)->plainTextToken,
        ]);

    }

}

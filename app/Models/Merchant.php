<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Merchant extends Model implements Authenticatable
{
    use HasFactory, SoftDeletes, HasApiTokens;
    protected $guarded = ['id'];

    protected $guard = 'merchant';

    public function image()
    {
        return $this->MorphOne(Image::class, 'image');
    }

    public function document()
    {
        return $this->MorphOne(Document::class, 'document');
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }
}

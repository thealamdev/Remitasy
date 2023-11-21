<?php

namespace App\Enums;

enum Bucket {
    case MERCHANT;
    case ADMIN;

    public function toString(): string
    {
        return match ($this) {
            self::MERCHANT => 'merchants',
            self::ADMIN => 'admins'
        };
    }
}

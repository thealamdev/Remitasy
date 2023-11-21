<?php

namespace App\Enums;

enum Bucket {
    case MERCHANT;
    case ADMIN;
    case DOCUMENT;

    public function toString(): string
    {
        return match ($this) {
            self::MERCHANT => 'merchants',
            self::ADMIN => 'admins',
            self::DOCUMENT => 'documents'
        };
    }
}

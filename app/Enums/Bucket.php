<?php

namespace App\Enums;

enum Bucket {
    case ADMIN;
    case MERCHANT;
    case AGENT;
    case DOCUMENT;

    public function toString(): string
    {
        return match ($this) {
            self::ADMIN => 'admins',
            self::MERCHANT => 'merchants',
            self::AGENT => 'agents',
            self::DOCUMENT => 'documents'
        };
    }
}

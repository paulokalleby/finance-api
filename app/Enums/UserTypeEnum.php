<?php

namespace App\Enums;

enum UserTypeEnum: string
{
    case PERSON = 'Person';
    case ADMIN  = 'Admin';

    public static function toArray(): array
    {
        return [
            self::PERSON => 'Person',
            self::ADMIN  => 'Admin',
        ];
    }

    public function label(): string
    {
        return match ($this) {
            self::PERSON => 'Pessoal',
            self::ADMIN  => 'Administrador',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PERSON => 'gren',
            self::ADMIN  => 'blue',
        };
    }
}

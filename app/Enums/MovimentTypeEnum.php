<?php

namespace App\Enums;

enum MovimentTypeEnum: string
{
    case INPUT  = 'Input';
    case OUTPUT = 'Output';

    public static function toArray(): array
    {
        return [
            self::INPUT  => 'Input',
            self::OUTPUT => 'Output',
        ];
    }

    public function label(): string
    {
        return match ($this) {
            self::INPUT  => 'Entrada',
            self::OUTPUT => 'Saida',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::INPUT   => 'green',
            self::OUTPUT  => 'red',
        };
    }
}

<?php

namespace App\Enums\Permissions;

enum Category: string
{
    case PUBLISH = 'publish category';
    case EDIT = 'edit category';
    case DELETE = 'delete account';

    public static function values(): array
    {
        $values = [];

        foreach (self::cases() as $case) {
            $values[] = $case->value;
        }

        return $values;
    }
}

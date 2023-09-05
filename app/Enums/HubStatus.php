<?php

namespace App\Enums;

enum HubStatus: string
{
    case Active = 'active';
    case Pending = 'pending';
    case Suspended = 'suspended';
    case Banned = 'banned';

    public static function values(): array
    {
        return [
            self::Active->value => 'Active',
            self::Pending->value => 'Pending',
            self::Suspended->value => 'Suspended',
            self::Banned->value => 'Banned',
        ];
    }
}

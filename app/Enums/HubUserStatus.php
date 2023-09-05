<?php

namespace App\Enums;

enum HubUserStatus: string
{
    case Owner = 'owner';
    case Moderator = 'moderator';
    case Member = 'member';
    case Pending = 'pending';
    case Invited = 'invited';
    case Muted = 'muted';
    case Banned = 'banned';
}

<?php

namespace App\Enums;

enum StatusEnum: string
{
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
    case BLOCKED = 'blocked';
}

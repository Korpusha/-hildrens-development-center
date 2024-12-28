<?php

namespace App\Enums;

enum RoleName: string
{
    case ADMIN = 'admin';
    case GUEST = 'guest';
    case TUTOR = 'tutor';
}

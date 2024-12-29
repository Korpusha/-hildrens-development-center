<?php

namespace App\Enums;

enum RoleName: string
{
    case Admin = 'admin';
    case Guest = 'guest';
    case Tutor = 'tutor';
}

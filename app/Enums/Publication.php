<?php

namespace App\Enums;

enum Publication: string
{
    case APPROVED = 'A';
    case PENDING = 'P';
    case REJECTED = 'R';
}

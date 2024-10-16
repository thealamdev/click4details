<?php

namespace App\Enums;

enum Status
{
    case ACTIVE;
    case INACTIVE;
    case TRUE;
    case FALSE;
    case SUCCESS;
    case ERROR;
    case WARNING;
    case DONE;
    case FAIL;

    public function toString(): string
    {
        return match ($this) {
            self::ACTIVE, self::TRUE    => '1',
            self::INACTIVE, self::FALSE => '0',
            self::DONE                  => 'Done',
            self::FAIL                  => 'Fail',
            self::SUCCESS               => 'success',
            self::ERROR                 => 'error',
            self::WARNING               => 'warning'
        };
    }
}

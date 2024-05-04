<?php

namespace App\Enums;

enum Status: int
{
    case DISACTIVE = 0;
    case ACTIVE = 1;



    public function badge()
    {
        return match ($this) {
            self::DISACTIVE => 'badge-danger',
            self::ACTIVE => 'badge-success',
        };
    }


    public function status()
    {
        return match ($this) {
            self::DISACTIVE => 'غير مفعل',
            self::ACTIVE => 'مفعل',
        };
    }
    public function elevator()
    {
        return match ($this) {
            self::DISACTIVE => 'لا يوجد',
            self::ACTIVE => 'يوجد',
        };
    }
    public function furnished()
    {
        return match ($this) {
            self::DISACTIVE => 'لا يوجد',
            self::ACTIVE => 'يوجد',
        };
    }
}
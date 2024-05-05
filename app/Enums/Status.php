<?php

namespace App\Enums;

enum Status: int
{
    case PENDEING = 1;
    case CANCELED = 2;
    case CONFIRMED = 3;
    case COMPLETED = 4;

    public function order()
    {
        return match ($this) {
            self::PENDEING => 'جاري الطلب',
            self::CANCELED => 'مرفوض',
            self::CONFIRMED => 'جاري التجهيز',
            self::COMPLETED => 'مكتمل',
        };
    }


    // public function badge()
    // {
    //     return match ($this) {
    //         self::DISACTIVE => 'badge-danger',
    //         self::ACTIVE => 'badge-success',
    //     };
    // }


    // public function status()
    // {
    //     return match ($this) {
    //         self::DISACTIVE => 'غير مفعل',
    //         self::ACTIVE => 'مفعل',
    //     };
    // }
}

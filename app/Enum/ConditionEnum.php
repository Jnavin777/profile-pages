<?php


namespace App\Enum;

use App\Enum\Base\AbstractEnum;

class ConditionEnum extends AbstractEnum
{
    const NEW = 'новое';
    const NEEDS_REPAIR  = 'нуждается в ремонте';

    public static $filterArray = [
        0 => ['value' => self::NEW, 'text' => self::NEW],
        1 => ['value' => self::NEEDS_REPAIR, 'text' => self::NEEDS_REPAIR],
    ];
}

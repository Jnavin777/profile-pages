<?php


namespace App\Enum;

use App\Enum\Base\AbstractEnum;

class ConditionEnum extends AbstractEnum
{
    const NEW = 'новое';
    const NEEDS_REPAIR  = 'нуждается в ремонте';
}

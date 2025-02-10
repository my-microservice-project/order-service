<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum QueueEnum: string
{
    use EnumTrait;

    case CREATE_DISCOUNTS = 'Create_Discounts';
    case DECREASE_STOCK = 'Decrease_Stock';
}

<?php

namespace App\Data\Order;

use App\Data\Campaign\CampaignResultDTO;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class OrderDTO extends Data
{
    public function __construct(
        public Collection $items,
        public float $total,
        public float $discounted_total,
        public int $customer_id,
        public CampaignResultDTO $campaigns,
    ) {}
}

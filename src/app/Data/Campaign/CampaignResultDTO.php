<?php

namespace App\Data\Campaign;


use Spatie\LaravelData\Data;

class CampaignResultDTO extends Data
{
    public function __construct(
        /** @var AppliedCampaignDTO[] */
        public array $appliedCampaigns,
        public float $finalTotal
    ) {}
}

<?php

namespace App\Data\Campaign;


use Spatie\LaravelData\Data;

class AppliedCampaignDTO extends Data
{
    public function __construct(
        public string $campaignName,
        public string $campaignType,
        public DiscountDetailsDTO $discountDetails
    ) {}
}

<?php

namespace App\Data\Campaign;

use Spatie\LaravelData\Data;

class DiscountsDTO extends Data
{
    public function __construct(
        public int $order_id,
        public string $campaign_name,
        public string $campaign_type,
        public float $discount_amount
    ) {}

    public static function fromAppliedCampaigns(int $orderId, array $appliedCampaigns): array
    {
        return collect($appliedCampaigns)->map(function ($campaign) use ($orderId) {
            return new self(
                order_id: $orderId,
                campaign_name: $campaign->campaignName,
                campaign_type: $campaign->campaignType,
                discount_amount: $campaign->discountDetails->discountAmount
            );
        })->toArray();
    }
}

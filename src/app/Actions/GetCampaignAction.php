<?php

namespace App\Actions;

use App\Data\Campaign\CampaignResultDTO;
use App\Data\Cart\CartDTO;
use BugraBozkurt\InterServiceCommunication\Facades\Campaign;
use Exception;

class GetCampaignAction
{
    /**
     * @throws Exception
     */
    public function execute(CartDTO $cart): CampaignResultDTO
    {
        $response = Campaign::post('/api/v1/calculate-discount', ['items' => $cart->items->toArray()]);

        if (!$response->successful()) {
            throw new Exception('Campaign service is not available');
        }

        $data = $response->json('data');

        return CampaignResultDTO::from($data);
    }

}

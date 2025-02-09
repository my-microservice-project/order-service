<?php

namespace App\Jobs;

use App\Services\DiscountService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateDiscountsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected array $discounts
    )
    {}

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        $discountService = app(DiscountService::class);

        $discountService->create($this->discounts);
    }
}

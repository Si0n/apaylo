<?php

namespace ApiIntegrations\Apaylo\DTO\Requests\Merchant;

use ApiIntegrations\Apaylo\Enum\Merchant\NormalizedTransactionType;
use GuzzleHttp\RequestOptions;

class GetAllTransactions
{
    public function __construct(
        protected \DateTimeInterface $startDate,
        protected \DateTimeInterface $endDate,
        protected ?NormalizedTransactionType $searchTransactionType = null,
    ) {
    }

    public function toGuzzleOptions(): array
    {
        return [
            RequestOptions::JSON => array_filter([
                'StartDate' => $this->startDate->format('Y-m-d'),
                'EndDate' => $this->endDate->format('Y-m-d'),
                'SearchTransactionType' => $this->searchTransactionType?->value,
            ]),
        ];
    }
}

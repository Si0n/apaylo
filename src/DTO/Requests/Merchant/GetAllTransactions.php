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
        protected string $dateFormat = 'Y-m-d H:i:s',
    ) {
    }

    public function toGuzzleOptions(): array
    {
        return [
            RequestOptions::JSON => array_filter([
                'StartDate' => $this->startDate->format($this->dateFormat),
                'EndDate' => $this->endDate->format($this->dateFormat),
                'SearchTransactionType' => $this->searchTransactionType?->value,
            ]),
        ];
    }
}

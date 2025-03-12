<?php

namespace ApiIntegrations\Apaylo\DTO\Requests\EFT;

use GuzzleHttp\RequestOptions;

class CancelTransaction
{
    public function __construct(
        protected string $transactionNumber,
        protected string $customerNumber
    ) {
    }

    public function toGuzzleOptions(): array
    {
        return [
            RequestOptions::JSON => [
                'TransactionNumber' => $this->transactionNumber,
                'CustomerNumber' => $this->customerNumber,
            ],
        ];
    }
}

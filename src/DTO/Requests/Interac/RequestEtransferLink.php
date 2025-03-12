<?php

namespace ApiIntegrations\Apaylo\DTO\Requests\Interac;

use GuzzleHttp\RequestOptions;

class RequestEtransferLink
{
    public function __construct(
        protected string $customerName,
        protected string $customerEmail,
        protected float $amount,
        protected string $description,
    ) {
    }

    public function toGuzzleOptions(): array
    {
        return [
            RequestOptions::JSON => [
                'CustomerName' => $this->customerName,
                'CustomerEmail' => $this->customerEmail,
                'Amount' => $this->amount,
                'Description' => $this->description,
            ],
        ];
    }
}

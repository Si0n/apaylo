<?php

namespace ApiIntegrations\Apaylo\DTO\Requests\EFT;

use GuzzleHttp\RequestOptions;

class DeleteCustomerAccount
{
    public function __construct(
        protected string $customerNumber,
        protected int $customerAccountId
    ) {
    }

    public function toGuzzleOptions(): array
    {
        return [
            RequestOptions::JSON => [
                'CustomerNumber' => $this->customerNumber,
                'CustomerAccountID' => $this->customerAccountId,
            ],
        ];
    }
}

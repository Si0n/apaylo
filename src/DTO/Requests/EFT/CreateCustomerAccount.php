<?php

namespace ApiIntegrations\Apaylo\DTO\Requests\EFT;

use GuzzleHttp\RequestOptions;

class CreateCustomerAccount
{
    public function __construct(
        protected string $customerNumber,
        protected string $accountName,
        protected string $transitNumber,
        protected string $institutionNumber,
        protected string $accountNumber
    ) {
    }

    public function toGuzzleOptions(): array
    {
        return [
            RequestOptions::JSON => [
                'CustomerNumber' => $this->customerNumber,
                'AccountName' => $this->accountName,
                'TransitNumber' => $this->transitNumber,
                'InstitutionNumber' => $this->institutionNumber,
                'AccountNumber' => $this->accountNumber,
            ],
        ];
    }
}

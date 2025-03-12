<?php

namespace ApiIntegrations\Apaylo\DTO\Requests\EFT;

use GuzzleHttp\RequestOptions;

class CreateCustomer
{
    public function __construct(
        protected string $email,
        protected string $firstName,
        protected string $lastName,
        protected string $transitNumber,
        protected string $institutionNumber,
        protected string $accountNumber,
        protected string $accountHolderName
    ) {
    }

    public function toGuzzleOptions(): array
    {
        return [
            RequestOptions::JSON => [
                'Email' => $this->email,
                'FirstName' => $this->firstName,
                'LastName' => $this->lastName,
                'TransitNumber' => $this->transitNumber,
                'InstitutionNumber' => $this->institutionNumber,
                'AccountNumber' => $this->accountNumber,
                'AccountHolderName' => $this->accountHolderName,
            ],
        ];
    }
}

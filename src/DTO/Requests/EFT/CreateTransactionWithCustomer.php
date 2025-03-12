<?php

namespace ApiIntegrations\Apaylo\DTO\Requests\EFT;

use ApiIntegrations\Apaylo\Enum\EFT\TransactionTypeCode;
use GuzzleHttp\RequestOptions;

class CreateTransactionWithCustomer
{
    public function __construct(
        protected string $email,
        protected string $firstName,
        protected string $lastName,
        protected string $transitNumber,
        protected string $institutionNumber,
        protected string $accountNumber,
        protected TransactionTypeCode $transactionTypeCode,
        protected float $amount,
        protected string $description
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
                'TransactionTypeCode' => $this->transactionTypeCode->value,
                'Amount' => $this->amount,
                'Description' => $this->description,
            ],
        ];
    }
}

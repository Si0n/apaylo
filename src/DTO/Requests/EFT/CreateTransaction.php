<?php

namespace ApiIntegrations\Apaylo\DTO\Requests\EFT;

use ApiIntegrations\Apaylo\Enum\EFT\TransactionTypeCode;
use GuzzleHttp\RequestOptions;

class CreateTransaction
{
    public function __construct(
        protected string $email,
        protected int $customerAccountId,
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
                'CustomerAccountID' => $this->customerAccountId,
                'TransactionTypeCode' => $this->transactionTypeCode->value,
                'Amount' => $this->amount,
                'Description' => $this->description,
            ],
        ];
    }
}

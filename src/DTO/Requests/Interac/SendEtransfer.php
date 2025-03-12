<?php

namespace ApiIntegrations\Apaylo\DTO\Requests\Interac;

use GuzzleHttp\RequestOptions;

class SendEtransfer
{
    public function __construct(
        protected string $customerName,
        protected string $customerEmail,
        protected float $amount,
        protected ?string $securityQuestion = null,
        protected ?string $securityQuestionAnswer = null,
        protected ?string $description = null,
    ) {
    }

    public function toGuzzleOptions(): array
    {
        return [
            RequestOptions::JSON => [
                'CustomerName' => $this->customerName,
                'CustomerEmail' => $this->customerEmail,
                'Amount' => $this->amount,
                'SecurityQuestion' => $this->securityQuestion,
                'SecurityQuestionAnswer' => $this->securityQuestionAnswer,
                'Description' => $this->description,
            ],
        ];
    }
}

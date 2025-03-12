<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\BillPayments;

class CreatedBillPayment
{
    public function __construct(
        protected ?string $message,
        protected ?string $transactionNumber,
        protected ?float $amount,
        protected ?string $description
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            message: $data['Message'] ?? null,
            transactionNumber: $data['TransactionNumber'] ?? null,
            amount: !empty($data['Amount']) ? (float) $data['Amount'] : null,
            description: $data['Description'] ?? null,
        );
    }
}

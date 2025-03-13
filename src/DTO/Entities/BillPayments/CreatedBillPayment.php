<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\BillPayments;

class CreatedBillPayment
{
    public function __construct(
        public ?string $message,
        public ?string $transactionNumber,
        public ?float $amount,
        public ?string $description
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

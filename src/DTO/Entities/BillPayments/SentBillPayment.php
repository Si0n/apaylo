<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\BillPayments;

use ApiIntegrations\Apaylo\DTO\Entities\ResultEntity;

class SentBillPayment implements ResultEntity
{
    public function __construct(
        protected ?string $customerName = null,
        protected ?string $transactionDate = null,
        protected ?float $amount = null,
        protected ?string $billAccountNumber = null,
        protected ?string $payeeName = null,
        protected ?string $description = null,
        protected ?string $transactionNumber = null,
    ) {
    }

    /**
     * @throws \DateMalformedStringException
     */
    public static function fromArray(array $data): self
    {
        return new self(
            customerName: $data['CustomerName'] ?? null,
            transactionDate: $data['TransactionDate'] ?? null,
            amount: $data['Amount'] ?? null,
            billAccountNumber: $data['BillAccountNumber'] ?? null,
            payeeName: $data['PayeeName'] ?? null,
            description: $data['Description'] ?? null,
            transactionNumber: $data['TransactionNumber'] ?? null,
        );
    }
}

<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\BillPayments;

use ApiIntegrations\Apaylo\DTO\Entities\ResultEntity;
use ApiIntegrations\Apaylo\Enum\BillPayments\BillPaymentTransactionStatus;

class SentBillPayment implements ResultEntity
{
    public function __construct(
        public ?string $customerName = null,
        public ?\DateTimeImmutable $transactionDate = null,
        public ?float $amount = null,
        public ?string $billAccountNumber = null,
        public ?string $payeeName = null,
        public ?string $description = null,
        public ?string $transactionNumber = null,
        public string | BillPaymentTransactionStatus | null $status = null,
    ) {
    }

    /**
     * @throws \DateMalformedStringException
     */
    public static function fromArray(array $data): self
    {
        return new self(
            customerName: $data['CustomerName'] ?? null,
            transactionDate: isset($data['TransactionDate']) && strtotime($data['TransactionDate']) ? new \DateTimeImmutable($data['TransactionDate']) : null,
            amount: $data['Amount'] ?? null,
            billAccountNumber: $data['BillAccountNumber'] ?? null,
            payeeName: $data['PayeeName'] ?? null,
            description: $data['Description'] ?? null,
            transactionNumber: $data['TransactionNumber'] ?? null,
            status: !empty($data['Status']) ? (BillPaymentTransactionStatus::tryFrom($data['Status']) ?? $data['Status']) : null,
        );
    }
}

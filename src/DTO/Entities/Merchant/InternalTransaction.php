<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\Merchant;

use ApiIntegrations\Apaylo\DTO\Entities\ResultEntity;

readonly class InternalTransaction implements ResultEntity
{
    public function __construct(
        public ?\DateTimeImmutable $transactionDate,
        public ?string $transactionNumber,
        public ?float $amount,
        public ?string $transactionType,
        public ?string $accountNumber,
        public ?string $customerName,
        public ?string $description,
        public ?string $uniqueId,
        public array $rawData = [],
    ) {
    }

    /**
     * @throws \DateMalformedStringException
     */
    public static function fromArray(array $data): self
    {
        return new self(
            transactionDate: isset($data['TransactionDate']) ? new \DateTimeImmutable($data['TransactionDate']) : null,
            transactionNumber: $data['TransactionNumber'] ?? null,
            amount: $data['Amount'] ?? null,
            transactionType: $data['TransactionType'] ?? null,
            accountNumber: $data['AccountNumber'] ?? null,
            customerName: $data['CustomerName'] ?? null,
            description: $data['Description'] ?? null,
            uniqueId: $data['UniqueId'] ?? null,
            rawData: $data,
        );
    }
}

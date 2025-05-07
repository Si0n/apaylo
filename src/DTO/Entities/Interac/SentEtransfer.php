<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\Interac;

use ApiIntegrations\Apaylo\DTO\Entities\ResultEntity;

readonly class SentEtransfer implements ResultEntity
{
    public function __construct(
        public ?string $interacReferenceNumber = null,
        public ?string $transactionNumber = null,
        public ?\DateTimeImmutable $transactionDate = null,
        public ?string $customerName = null,
        public ?string $description = null,
    ) {
    }

    /**
     * @throws \DateMalformedStringException
     */
    public static function fromArray(array $data): self
    {
        return new self(
            interacReferenceNumber: $data['InteracReferenceNumber'] ?? null,
            transactionNumber: $data['TransactionNumber'] ?? null,
            transactionDate: isset($data['TransactionDate']) ? new \DateTimeImmutable($data['TransactionDate']) : null,
            customerName: $data['CustomerName'] ?? null,
            description: $data['Description'] ?? null,
        );
    }
}

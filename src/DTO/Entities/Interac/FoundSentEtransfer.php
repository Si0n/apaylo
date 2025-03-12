<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\Interac;

use ApiIntegrations\Apaylo\DTO\Entities\ResultEntity;
use ApiIntegrations\Apaylo\Enum\Interac\InteracTransactionStatus;

readonly class FoundSentEtransfer implements ResultEntity
{
    public function __construct(
        public ?string $interacReferenceNumber,
        public ?string $transactionNumber,
        public ?InteracTransactionStatus $transactionStatus,
        public ?\DateTimeInterface $transactionDate,
        public ?string $customerName,
        public ?string $customerEmail,
        public ?string $dcbTransactionId,
        public ?string $description,
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
            transactionStatus: !empty($data['TransactionStatus']) ? InteracTransactionStatus::tryFrom($data['TransactionStatus']) : null,
            transactionDate: isset($data['TransactionDate']) ? new \DateTimeImmutable($data['TransactionDate']) : null,
            customerName: $data['CustomerName'] ?? null,
            customerEmail: $data['CustomerEmail'] ?? null,
            dcbTransactionId: $data['DcbTransactionId'] ?? null,
            description: $data['Description'] ?? null,
        );
    }
}

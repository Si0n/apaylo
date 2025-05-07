<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\Merchant;

use ApiIntegrations\Apaylo\DTO\Entities\ResultEntity;
use ApiIntegrations\Apaylo\Enum\Merchant\NormalizedTransactionType;

readonly class NormalizedTransaction implements ResultEntity
{
    public function __construct(
        public ?\DateTimeImmutable $transactionDate,
        public ?NormalizedTransactionType $typOfTransaction,
        public ?float $amount,
        public ?string $description,
        public ?string $fullName,
        public ?string $transactionId,
    ) {
    }

    /**
     * @throws \DateMalformedStringException
     */
    public static function fromArray(array $data): self
    {
        return new self(
            transactionDate: isset($data['TransactionDate']) ? new \DateTimeImmutable($data['TransactionDate']) : null,
            typOfTransaction: !empty($data['TypeOfTransaction']) ? NormalizedTransactionType::tryFrom($data['TypeOfTransaction']) : null,
            amount: $data['Amount'] ?? null,
            description: $data['Description'] ?? null,
            fullName: $data['FullName'] ?? null,
            transactionId: $data['TransactionId'] ?? null,
        );
    }
}

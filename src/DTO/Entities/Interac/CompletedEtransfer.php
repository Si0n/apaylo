<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\Interac;

use ApiIntegrations\Apaylo\DTO\Entities\ResultEntity;

readonly class CompletedEtransfer implements ResultEntity
{
    public function __construct(
        public ?\DateTimeInterface $transactionDate,
        public ?string $senderName,
        public ?string $senderBankName,
        public ?string $senderBankTransitNumber,
        public ?string $accountNumber,
        public ?string $transactionType,
        public ?float $amount,
        public ?string $referenceNumber,
        public ?string $description,
        public ?string $transactionReferenceNumber,
        public ?bool $isAutoDeposit,
    ) {
    }

    /**
     * @throws \DateMalformedStringException
     */
    public static function fromArray(array $data): self
    {
        $isAutoDeposit = $data['IsAutoDeposit'] ?? null;

        $isAutoDeposit = match (true) {
            is_string($isAutoDeposit) && 'true' === strtolower($isAutoDeposit) => true,
            is_bool($isAutoDeposit) => $isAutoDeposit,
            default => null,
        };

        return new self(
            transactionDate: isset($data['TransactionDate']) ? new \DateTimeImmutable($data['TransactionDate']) : null,
            senderName: $data['SenderName'] ?? null,
            senderBankName: $data['SenderBankName'] ?? null,
            senderBankTransitNumber: $data['SenderBankTransitNumber'] ?? null,
            accountNumber: $data['AccountNumber'] ?? null,
            transactionType: $data['TransactionType'] ?? null,
            amount: $data['Amount'] ?? null,
            referenceNumber: $data['ReferenceNumber'] ?? null,
            description: $data['Description'] ?? null,
            transactionReferenceNumber: $data['TransactionReferenceNumber'] ?? null,
            isAutoDeposit: $isAutoDeposit
        );
    }
}

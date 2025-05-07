<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\EFT;

use ApiIntegrations\Apaylo\DTO\Entities\ResultEntity;
use ApiIntegrations\Apaylo\Enum\EFT\EFTTransactionStatus;
use ApiIntegrations\Apaylo\Enum\EFT\EFTTypeCode;
use ApiIntegrations\Apaylo\Enum\EFT\TransactionTypeCode;

readonly class FoundTransaction implements ResultEntity
{
    public function __construct(
        public ?string $transactionId,
        public ?string $transactionNumber,
        public ?string $customerNumber,
        public ?int $customerAccountId,
        public ?TransactionTypeCode $transactionTypeCode,
        public ?string $transactionTypeDescription,
        public ?EFTTypeCode $eftTypeCode,
        public ?string $eftTypeDescription,
        public ?\DateTimeImmutable $transactionDate,
        public ?float $amount,
        public ?EFTTransactionStatus $transactionStatus,
        public ?string $transactionDescription,
        public ?string $returnCode,
        public ?\DateTimeImmutable $returnDate = null,
        public ?string $uniqueId = null,
        public array $rawData = [],
    ) {
    }

    /**
     * @throws \DateMalformedStringException
     */
    public static function fromArray(array $data): self
    {
        return new self(
            transactionId: $data['TransactionId'] ?? null,
            transactionNumber: $data['TransactionNumber'] ?? null,
            customerNumber: $data['CustomerNumber'] ?? null,
            customerAccountId: $data['CustomerAccountId'] ?? null,
            transactionTypeCode: !empty($data['TransactionTypeCode']) ? TransactionTypeCode::tryFrom($data['TransactionTypeCode']) : null,
            transactionTypeDescription: $data['TransactionTypeDescription'] ?? null,
            eftTypeCode: !empty($data['EftTypeCode']) ? EFTTypeCode::tryFrom($data['EftTypeCode']) : null,
            eftTypeDescription: $data['EftTypeDescription'] ?? null,
            transactionDate: (isset($data['TransactionDate']) && strtotime($data['TransactionDate'])) ? new \DateTimeImmutable($data['TransactionDate']) : null,
            amount: $data['Amount'] ?? null,
            transactionStatus: !empty($data['TransactionStatus']) ? EFTTransactionStatus::tryFrom($data['TransactionStatus']) : null,
            transactionDescription: $data['TransactionDescription'] ?? null,
            returnCode: $data['ReturnCode'] ?? null,
            returnDate: (isset($data['ReturnDate']) && strtotime($data['ReturnDate'])) ? new \DateTimeImmutable($data['ReturnDate']) : null,
            uniqueId: $data['UniqueId'] ?? null,
            rawData: $data,
        );
    }
}

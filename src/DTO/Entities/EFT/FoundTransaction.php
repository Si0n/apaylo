<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\EFT;

use ApiIntegrations\Apaylo\DTO\Entities\ResultEntity;
use ApiIntegrations\Apaylo\Enum\EFT\EFTTransactionStatus;
use ApiIntegrations\Apaylo\Enum\EFT\EFTTypeCode;
use ApiIntegrations\Apaylo\Enum\EFT\TransactionTypeCode;

readonly class FoundTransaction implements ResultEntity
{
    public function __construct(
        protected ?string $transactionId,
        protected ?string $transactionNumber,
        protected ?string $customerNumber,
        protected ?int $customerAccountId,
        protected ?TransactionTypeCode $transactionTypeCode,
        protected ?string $transactionTypeDescription,
        protected ?EFTTypeCode $eftTypeCode,
        protected ?string $eftTypeDescription,
        protected ?\DateTimeInterface $transactionDate,
        protected ?float $amount,
        protected ?EFTTransactionStatus $transactionStatus,
        protected ?string $transactionDescription,
        protected ?string $returnCode
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
            eftTypeCode: !empty($data['EFTTypeCode']) ? EFTTypeCode::tryFrom($data['EFTTypeCode']) : null,
            eftTypeDescription: $data['EFTTypeDescription'] ?? null,
            transactionDate: isset($data['TransactionDate']) ? new \DateTimeImmutable($data['TransactionDate']) : null,
            amount: $data['Amount'] ?? null,
            transactionStatus: !empty($data['TransactionStatus']) ? EFTTransactionStatus::tryFrom($data['TransactionStatus']) : null,
            transactionDescription: $data['TransactionDescription'] ?? null,
            returnCode: $data['ReturnCode'] ?? null
        );
    }
}

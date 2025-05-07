<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\Merchant;

use ApiIntegrations\Apaylo\DTO\Entities\ResultEntity;
use ApiIntegrations\Apaylo\Enum\Merchant\TransactionRail;
use ApiIntegrations\Apaylo\Enum\Merchant\TransactionType;

readonly class ReportTransactionItem implements ResultEntity
{
    public function __construct(
        public ?\DateTimeImmutable $dateTime,
        public ?float $startingBalance,
        public ?string $transactionNumber,
        public TransactionRail | string | null $transactionRail,
        public ?float $transactionAmount,
        public ?TransactionType $transactionType,
        public ?string $customerName,
        public ?string $description,
        public ?float $endingBalance,
    ) {
    }

    /**
     * @throws \DateMalformedStringException
     */
    public static function fromArray(array $data): self
    {
        $rail = $data['TransactionRail'] ?? null;
        if (TransactionRail::tryFrom($rail)) {
            $rail = TransactionRail::from($rail);
        }

        return new self(
            dateTime: isset($data['DateTime']) ? new \DateTimeImmutable($data['DateTime']) : null,
            startingBalance: $data['StartingBalance'] ?? null,
            transactionNumber: $data['TransactionNumber'] ?? null,
            transactionRail: $rail,
            transactionAmount: $data['TransactionAmount'] ?? null,
            transactionType: !empty($data['TransactionType']) ? TransactionType::tryFrom($data['TransactionType']) : null,
            customerName: $data['CustomerName'] ?? null,
            description: $data['Description'] ?? null,
            endingBalance: $data['EndingBalance'] ?? null,
        );
    }
}

<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\EFT;

use ApiIntegrations\Apaylo\DTO\Entities\ResultEntity;

readonly class CreatedTransaction implements ResultEntity
{
    public function __construct(
        public ?string $message,
        public ?string $transactionNumber
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            message: $data['Message'] ?? null,
            transactionNumber: $data['TransactionNumber'] ?? null
        );
    }
}

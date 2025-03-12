<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\Interac;

use ApiIntegrations\Apaylo\DTO\Entities\ResultEntity;

readonly class RequestedEtransferLink implements ResultEntity
{
    public function __construct(
        public ?string $message,
        public ?string $referenceNumber,
        public ?string $transactionNumber,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            message: $data['Message'] ?? null,
            referenceNumber: $data['ReferenceNumber'] ?? null,
            transactionNumber: $data['TransactionNumber'] ?? null,
        );
    }
}

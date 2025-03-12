<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\EFT;

use ApiIntegrations\Apaylo\DTO\Entities\ResultEntity;

readonly class FoundCustomerAccount implements ResultEntity
{
    public function __construct(
        public ?int $customerAccountId,
        public ?string $customerNumber,
        public ?string $accountName,
        public ?string $accountNumber,
        public ?string $transitNumber,
        public ?string $institutionNumber
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            customerAccountId: $data['CustomerAccountId'] ?? null,
            customerNumber: $data['CustomerNumber'] ?? null,
            accountName: $data['AccountName'] ?? null,
            accountNumber: $data['AccountNumber'] ?? null,
            transitNumber: $data['TransitNumber'] ?? null,
            institutionNumber: $data['InstitutionNumber'] ?? null
        );
    }
}

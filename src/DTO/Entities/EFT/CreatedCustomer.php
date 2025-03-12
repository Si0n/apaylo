<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\EFT;

use ApiIntegrations\Apaylo\DTO\Entities\ResultEntity;

readonly class CreatedCustomer implements ResultEntity
{
    public function __construct(
        public ?string $message,
        public ?string $customerNumber,
        public ?int $customerAccountID
    ) {
    }

    /**
     * sandbox data:   transitNumber: '07269', institutionNumber: '219'.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            message: $data['Message'] ?? null,
            customerNumber: $data['CustomerNumber'] ?? null,
            customerAccountID: $data['CustomerAccountID'] ?? null
        );
    }
}

<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\EFT;

use ApiIntegrations\Apaylo\DTO\Entities\ResultEntity;

readonly class CreatedCustomerAccount implements ResultEntity
{
    public function __construct(
        public ?string $message,
        public ?int $customerAccountId
    ) {
    }

    /**
     * sandbox data:   transitNumber: '07269', institutionNumber: '219'.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            message: $data['Message'] ?? null,
            customerAccountId: $data['CustomerAccountID'] ?? null
        );
    }
}

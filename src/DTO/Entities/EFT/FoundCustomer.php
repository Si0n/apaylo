<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\EFT;

use ApiIntegrations\Apaylo\DTO\Entities\ResultEntity;
use ApiIntegrations\Apaylo\Enum\EFT\CustomerTypeCode;

readonly class FoundCustomer implements ResultEntity
{
    public function __construct(
        public ?string $customerNumber,
        public ?string $customerName,
        public ?CustomerTypeCode $customerTypeCode,
        public ?string $programList,
        public ?string $email,
        public ?string $customerStatus
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            customerNumber: $data['CustomerNumber'] ?? null,
            customerName: $data['CustomerName'] ?? null,
            customerTypeCode: !empty($data['CustomerTypeCode']) ? CustomerTypeCode::tryFrom($data['CustomerTypeCode']) : null,
            programList: $data['ProgramList'] ?? null,
            email: $data['Email'] ?? null,
            customerStatus: $data['CustomerStatus'] ?? null
        );
    }
}

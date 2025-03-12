<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\BillPayments;

class FoundPayee
{
    public function __construct(
        protected ?string $payeeName,
        protected ?string $payeeCode
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            payeeName: $data['PayeeName'] ?? null,
            payeeCode: $data['PayeeCode'] ?? null
        );
    }
}

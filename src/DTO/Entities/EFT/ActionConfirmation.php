<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\EFT;

use ApiIntegrations\Apaylo\DTO\Entities\ResultEntity;

readonly class ActionConfirmation implements ResultEntity
{
    public function __construct(
        public ?string $message,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            message: $data['Message'] ?? null,
        );
    }
}

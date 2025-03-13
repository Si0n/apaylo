<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\Merchant;

use ApiIntegrations\Apaylo\DTO\Entities\ResultEntity;

readonly class HealthCheck implements ResultEntity
{
    public function __construct(
        public ?string $message = null,
        public ?\DateTimeInterface $time = null,
    ) {
    }

    /**
     * @throws \DateMalformedStringException
     */
    public static function fromArray(array $data): self
    {
        return new self(
            message: $data['Message'] ?? null,
            time: !empty($data['Time']) ? new \DateTimeImmutable($data['Time']) : null,
        );
    }
}

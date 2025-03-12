<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\General;

readonly class AuthCredentials
{
    public function __construct(
        public ?string $apiKey,
        public ?string $sharedSecret,
    ) {
    }
}

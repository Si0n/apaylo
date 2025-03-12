<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\General;

use ApiIntegrations\Apaylo\Enum\ApiEnv;

readonly class ApiDomains
{
    public function __construct(public array $domains)
    {
    }

    public function getDomainByEnv(ApiEnv $env): ?string
    {
        return $this->domains[$env->value] ?? null;
    }
}

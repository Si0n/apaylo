<?php

namespace ApiIntegrations\Apaylo\DTO\Entities;

interface ResultEntity
{
    public static function fromArray(array $data): self;
}

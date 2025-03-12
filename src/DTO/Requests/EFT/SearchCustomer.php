<?php

namespace ApiIntegrations\Apaylo\DTO\Requests\EFT;

use GuzzleHttp\RequestOptions;

class SearchCustomer
{
    public function __construct(protected string $email)
    {
    }

    public function toGuzzleOptions(): array
    {
        return [
            RequestOptions::JSON => ['Email' => $this->email],
        ];
    }
}

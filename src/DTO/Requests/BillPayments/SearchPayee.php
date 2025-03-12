<?php

namespace ApiIntegrations\Apaylo\DTO\Requests\BillPayments;

use GuzzleHttp\RequestOptions;

class SearchPayee
{
    public function __construct(protected string $name)
    {
    }

    public function toGuzzleOptions(): array
    {
        return [
            RequestOptions::JSON => ['Name' => $this->name],
        ];
    }
}

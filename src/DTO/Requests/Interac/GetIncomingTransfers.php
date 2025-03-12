<?php

namespace ApiIntegrations\Apaylo\DTO\Requests\Interac;

use GuzzleHttp\RequestOptions;

class GetIncomingTransfers
{
    public function __construct(
        protected string $referenceNumber,
    ) {
    }

    public function toGuzzleOptions(): array
    {
        return [
            RequestOptions::JSON => [
                'ReferenceNumber' => $this->referenceNumber,
            ],
        ];
    }
}

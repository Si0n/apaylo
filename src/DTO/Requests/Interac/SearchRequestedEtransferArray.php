<?php

namespace ApiIntegrations\Apaylo\DTO\Requests\Interac;

use GuzzleHttp\RequestOptions;

class SearchRequestedEtransferArray
{
    public function __construct(
        protected array $transactionNumbers,
    ) {
    }

    public function toGuzzleOptions(): array
    {
        return [
            RequestOptions::JSON => array_filter([
                'TransactionNumbers' => $this->transactionNumbers,
            ]),
        ];
    }
}

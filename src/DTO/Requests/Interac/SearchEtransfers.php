<?php

namespace ApiIntegrations\Apaylo\DTO\Requests\Interac;

use GuzzleHttp\RequestOptions;

class SearchEtransfers
{
    public function __construct(
        protected \DateTimeInterface $startDate,
        protected \DateTimeInterface $endDate,
    ) {
    }

    public function toGuzzleOptions(): array
    {
        return [
            RequestOptions::JSON => array_filter([
                'StartDate' => $this->startDate->format('Y-m-d'),
                'EndDate' => $this->endDate->format('Y-m-d'),
            ]),
        ];
    }
}

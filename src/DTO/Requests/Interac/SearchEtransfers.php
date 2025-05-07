<?php

namespace ApiIntegrations\Apaylo\DTO\Requests\Interac;

use GuzzleHttp\RequestOptions;

class SearchEtransfers
{
    public function __construct(
        protected \DateTimeInterface $startDate,
        protected \DateTimeInterface $endDate,
        protected string $dateFormat = 'Y-m-d H:i:s',
    ) {
    }

    public function toGuzzleOptions(): array
    {
        return [
            RequestOptions::JSON => array_filter([
                'StartDate' => $this->startDate->format($this->dateFormat),
                'EndDate' => $this->endDate->format($this->dateFormat),
            ]),
        ];
    }
}

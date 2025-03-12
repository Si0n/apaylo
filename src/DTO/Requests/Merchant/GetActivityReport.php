<?php

namespace ApiIntegrations\Apaylo\DTO\Requests\Merchant;

use GuzzleHttp\RequestOptions;

class GetActivityReport
{
    public function __construct(
        protected \DateTimeInterface $startDate,
        protected \DateTimeInterface $endDate
    ) {
        if ($this->startDate->diff($this->endDate)->days > 31) {
            throw new \InvalidArgumentException('The date range should not exceed 1 month.');
        }
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

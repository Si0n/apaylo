<?php

namespace ApiIntegrations\Apaylo\DTO\Requests\Merchant;

use GuzzleHttp\RequestOptions;

class GetActivityReport
{
    public function __construct(
        protected \DateTimeInterface $startDate,
        protected \DateTimeInterface $endDate,
        protected string $dateFormat = 'Y-m-d H:i:s',
    ) {
        if ($this->startDate->diff($this->endDate)->days > 31) {
            throw new \InvalidArgumentException('The date range should not exceed 1 month.');
        }
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

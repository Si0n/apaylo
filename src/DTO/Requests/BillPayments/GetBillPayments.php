<?php

namespace ApiIntegrations\Apaylo\DTO\Requests\BillPayments;

use GuzzleHttp\RequestOptions;

class GetBillPayments
{
    /**
     * @param \DateTimeInterface $startDate    Indicates the minimum date of transaction
     * @param \DateTimeInterface $endDate      Indicates the maximum date of transaction
     * @param string|null        $searchString Search for Bill Pay Transaction data based on the search string
     */
    public function __construct(
        protected \DateTimeInterface $startDate,
        protected \DateTimeInterface $endDate,
        protected ?string $searchString = null,
    ) {
    }

    public function toGuzzleOptions(): array
    {
        return [
            RequestOptions::JSON => array_filter([
                'StartDate' => $this->startDate?->format('Y-m-d'),
                'EndDate' => $this->endDate?->format('Y-m-d'),
                'SearchString' => $this->searchString,
            ]),
        ];
    }
}

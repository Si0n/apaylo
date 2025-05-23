<?php

namespace ApiIntegrations\Apaylo\DTO\Requests\Interac;

use ApiIntegrations\Apaylo\Enum\Interac\InteracTransactionStatus;
use GuzzleHttp\RequestOptions;

class SearchRequestedEtransfer
{
    public function __construct(
        protected \DateTimeInterface $startDate,
        protected \DateTimeInterface $endDate,
        protected ?string $description = null,
        protected ?string $transactionNumber = null,
        protected ?string $interacReferenceNumber = null,
        protected ?InteracTransactionStatus $status = null,
        protected string $dateFormat = 'Y-m-d H:i:s',
    ) {
    }

    public function toGuzzleOptions(): array
    {
        return [
            RequestOptions::JSON => array_filter([
                'StartDate' => $this->startDate->format($this->dateFormat),
                'EndDate' => $this->endDate->format($this->dateFormat),
                'Description' => $this->description,
                'TransactionNumber' => $this->transactionNumber,
                'InteracReferenceNumber' => $this->interacReferenceNumber,
                'Status' => $this->status?->value,
            ]),
        ];
    }
}

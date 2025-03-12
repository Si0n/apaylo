<?php

namespace ApiIntegrations\Apaylo\DTO\Requests\EFT;

use GuzzleHttp\RequestOptions;

class SearchCustomerAccount
{
    /***
     * @param string $customerNumber       Indicates unique Customer Number and can be retrieved from SearchCustomer API.
     * @param ?int $customerAccountId        Indicates Unique EFT Account Id.
     */
    public function __construct(
        protected string $customerNumber,
        protected ?int $customerAccountId = null
    ) {
    }

    public function toGuzzleOptions(): array
    {
        return [
            RequestOptions::JSON => array_filter([
                'CustomerNumber' => $this->customerNumber,
                'CustomerAccountID' => $this->customerAccountId,
            ]),
        ];
    }
}

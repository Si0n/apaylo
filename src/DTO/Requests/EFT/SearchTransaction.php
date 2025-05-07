<?php

namespace ApiIntegrations\Apaylo\DTO\Requests\EFT;

use ApiIntegrations\Apaylo\Enum\EFT\EFTTypeCode;
use ApiIntegrations\Apaylo\Enum\EFT\TransactionTypeCode;
use GuzzleHttp\RequestOptions;

class SearchTransaction
{
    /**
     * @param string|null              $customerNumber      indicates unique Customer Number and can be retrieved from CreateCustomer API
     * @param string|null              $transactionNumber   the Id of the Transaction, this value is returned to you when creating the EFT via the CreateEFTTransaction API
     * @param EFTTypeCode|null         $eftTypeCode         Indicates Code for EFT Type. P is for Priority and R is for Regular.
     * @param TransactionTypeCode|null $transactionTypeCode indicates the Type of transaction namely C is for Credit and D is for Debit
     * @param float|null               $minAmount           indicates the minimum amount of money that has been sent/deposited
     * @param float|null               $maxAmount           indicates the maximum amount of money that has been sent/deposited
     * @param \DateTimeInterface|null  $minTransactionDate  indicates the minimum date of transaction in the format YYYY-MM-DD
     * @param \DateTimeInterface|null  $maxTransactionDate  indicates the maximum date of transaction in the format YYYY-MM-DD
     */
    public function __construct(
        protected ?string $customerNumber = null,
        protected ?string $transactionNumber = null,
        protected ?EFTTypeCode $eftTypeCode = null,
        protected ?TransactionTypeCode $transactionTypeCode = null,
        protected ?float $minAmount = null,
        protected ?float $maxAmount = null,
        protected ?\DateTimeInterface $minTransactionDate = null,
        protected ?\DateTimeInterface $maxTransactionDate = null,
        protected string $dateFormat = 'Y-m-d H:i:s',
    ) {
    }

    public function toGuzzleOptions(): array
    {
        return [
            RequestOptions::JSON => array_filter([
                'CustomerNumber' => $this->customerNumber,
                'TransactionNumber' => $this->transactionNumber,
                'EftTypeCode' => $this->eftTypeCode?->value,
                'TransactionTypeCode' => $this->transactionTypeCode?->value,
                'MinAmount' => $this->minAmount,
                'MaxAmount' => $this->maxAmount,
                'MinTransactionDate' => $this->minTransactionDate?->format($this->dateFormat),
                'MaxTransactionDate' => $this->maxTransactionDate?->format($this->dateFormat),
            ]),
        ];
    }
}

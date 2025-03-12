<?php

namespace ApiIntegrations\Apaylo\DTO\Requests\BillPayments;

use GuzzleHttp\RequestOptions;

class CreateBillPayment
{
    /**
     * @param string $payeeName Name of Payee returned from /Merchant/SearchPayee
     * @param string $payeeCode Code of Payee returned from /Merchant/SearchPayee
     * @param float  $amount    Indicates the amount of money that is to be sent
     */
    public function __construct(
        protected string $email,
        protected string $firstName,
        protected string $lastName,
        protected string $payeeName,
        protected string $payeeCode,
        protected float $amount,
        protected string $payeeAccountNumber,
        protected ?string $description
    ) {
    }

    public function toGuzzleOptions(): array
    {
        return [
            RequestOptions::JSON => [
                'Email' => $this->email,
                'FirstName' => $this->firstName,
                'LastName' => $this->lastName,
                'PayeeName' => $this->payeeName,
                'PayeeCode' => $this->payeeCode,
                'Amount' => $this->amount,
                'PayeeAccountNumber' => $this->payeeAccountNumber,
                'Description' => $this->description,
            ],
        ];
    }
}

<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\BillPayments;

use ApiIntegrations\Apaylo\DTO\Entities\ResultEntity;

class BillPayment implements ResultEntity
{
    /**
     * @param \DateTimeInterface|null $settlementDate The settlement date is the date when the payment is final
     * @param string|null             $customerAcctNo The Customer Account Number includes both the Bill Pay Prefix and the customer's account number
     */
    public function __construct(
        public ?\DateTimeInterface $settlementDate,
        public ?string $processInstName,
        public ?float $paymentAmount,
        public ?string $customerAcctNo,
        public ?string $remitterName,
        public ?\DateTimeInterface $transactionDate,
        public ?string $traceNo,
        public ?string $transactionNumber,
    ) {
    }

    /**
     * @throws \DateMalformedStringException
     */
    public static function fromArray(array $data): self
    {
        return new self(
            settlementDate: !empty($data['SettlementDate']) ? new \DateTimeImmutable($data['SettlementDate']) : null,
            processInstName: $data['ProcessInstName'] ?? null,
            paymentAmount: !empty($data['PaymentAmount']) ? (float) $data['PaymentAmount'] : null,
            customerAcctNo: $data['CustomerAcctNo'] ?? null,
            remitterName: $data['RemitterName'] ?? null,
            transactionDate: !empty($data['TransactionDate']) ? new \DateTimeImmutable($data['TransactionDate']) : null,
            traceNo: $data['TraceNo'] ?? null,
            transactionNumber: $data['TransactionNumber'] ?? null,
        );
    }
}

<?php

namespace ApiIntegrations\Apaylo\DTO\Entities\Interac;

use ApiIntegrations\Apaylo\DTO\Entities\ResultEntity;

readonly class IncomingTransfer implements ResultEntity
{
    public function __construct(
        public ?int $productCode,
        public ?int $transferType,
        public ?int $transferStatus,
        public ?string $participantId,
        public ?string $currencyCode,
        public ?float $amount,
        public ?\DateTimeInterface $expiryDate,
        public ?string $senderMemo,
        public ?string $language,
        public ?string $senderRegistrationName,
        public ?int $authenticationRequired,
        public ?int $authenticationType,
        public ?bool $authenticationTypeSpecified,
        public ?string $securityQuestion,
        public ?string $hashType,
        public ?string $hashSalt,
        public ?string $senderSupplementaryInfo,
        public ?string $transferReferenceNumber,
    ) {
    }

    /**
     * @throws \DateMalformedStringException
     */
    public static function fromArray(array $data): self
    {
        return new self(
            productCode: $data['ProductCode'] ?? null,
            transferType: $data['TransferType'] ?? null,
            transferStatus: $data['TransferStatus'] ?? null,
            participantId: $data['ParticipantId'] ?? null,
            currencyCode: $data['CurrencyCode'] ?? null,
            amount: $data['Amount'] ?? null,
            expiryDate: isset($data['ExpiryDate']) ? new \DateTimeImmutable($data['ExpiryDate']) : null,
            senderMemo: $data['SenderMemo'] ?? null,
            language: $data['Language'] ?? null,
            senderRegistrationName: $data['SenderRegistrationName'] ?? null,
            authenticationRequired: $data['AuthenticationRequired'] ?? null,
            authenticationType: $data['AuthenticationType'] ?? null,
            authenticationTypeSpecified: $data['AuthenticationTypeSpecified'] ?? null,
            securityQuestion: $data['SecurityQuestion'] ?? null,
            hashType: $data['HashType'] ?? null,
            hashSalt: $data['HashSalt'] ?? null,
            senderSupplementaryInfo: $data['SenderSupplementaryInfo'] ?? null,
            transferReferenceNumber: $data['TransferReferenceNumber'] ?? null,
        );
    }
}

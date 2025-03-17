<?php

namespace ApiIntegrations\Apaylo;

use ApiIntegrations\Apaylo\ApiClient\ApiClient;
use ApiIntegrations\Apaylo\ApiClient\ClientBillPayments;
use ApiIntegrations\Apaylo\ApiClient\ClientEFT;
use ApiIntegrations\Apaylo\ApiClient\ClientInterac;
use ApiIntegrations\Apaylo\ApiClient\ClientMerchant;
use ApiIntegrations\Apaylo\ApiClient\EnvClientManager;
use ApiIntegrations\Apaylo\Enum\ApiClientType;

class ApayloManager
{
    protected array $apiClients = [];

    public function __construct(
        protected EnvClientManager $envClientManager,
    ) {
    }

    /**
     * @template T of ApiClient
     *
     * @return (
     *     $apiClientType is ApiClientType::BILL_PAYMENTS ? ClientBillPayments :
     *     ($apiClientType is ApiClientType::EFT ? ClientEFT :
     *     ($apiClientType is ApiClientType::INTERAC ? ClientInterac :
     *     ($apiClientType is ApiClientType::MERCHANT ? ClientMerchant : ApiClient)))
     * )
     *
     * @phpstan-return (
     *     $apiClientType is ApiClientType::BILL_PAYMENTS ? ClientBillPayments :
     *     ($apiClientType is ApiClientType::EFT ? ClientEFT :
     *     ($apiClientType is ApiClientType::INTERAC ? ClientInterac :
     *     ($apiClientType is ApiClientType::MERCHANT ? ClientMerchant : ApiClient)))
     * )
     *
     * @psalm-return (
     *     $apiClientType is ApiClientType::BILL_PAYMENTS ? ClientBillPayments :
     *     ($apiClientType is ApiClientType::EFT ? ClientEFT :
     *     ($apiClientType is ApiClientType::INTERAC ? ClientInterac :
     *     ($apiClientType is ApiClientType::MERCHANT ? ClientMerchant : ApiClient)))
     * )
     */
    public function getApiClient(ApiClientType $apiClientType): ApiClient
    {
        if (!isset($this->apiClients[$apiClientType->value])) {
            $this->apiClients[$apiClientType->value] = $this->initializeClient($apiClientType);
        }

        return $this->apiClients[$apiClientType->value];
    }

    protected function initializeClient(ApiClientType $apiClientType): ApiClient
    {
        return match ($apiClientType) {
            ApiClientType::BILL_PAYMENTS => new ClientBillPayments($this->envClientManager),
            ApiClientType::EFT => new ClientEFT($this->envClientManager),
            ApiClientType::INTERAC => new ClientInterac($this->envClientManager),
            ApiClientType::MERCHANT => new ClientMerchant($this->envClientManager),
        };
    }
}

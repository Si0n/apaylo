<?php

namespace ApiIntegrations\Apaylo\ApiClient;

use ApiIntegrations\Apaylo\DTO\Entities\EFT as Entities;
use ApiIntegrations\Apaylo\DTO\Entities\ResponseCollection;
use ApiIntegrations\Apaylo\DTO\Entities\ResponseItem;
use ApiIntegrations\Apaylo\DTO\Requests\EFT as Requests;
use ApiIntegrations\Apaylo\Enum\ApiEnv;

/**
 * @description Apaylo HTTP client
 */
class ClientEFT implements ApiClient
{
    protected const string CREATE_CUSTOMER = 'EFT/CreateCustomer';
    protected const string CREATE_CUSTOMER_ACCOUNT = 'EFT/CreateEFTCustomerAccount';
    protected const string DELETE_CUSTOMER_ACCOUNT = 'EFT/DeleteEFTCustomerAccount';
    protected const string SEARCH_CUSTOMER = 'EFT/SearchCustomer';
    protected const string SEARCH_CUSTOMER_ACCOUNT = 'EFT/SearchEFTCustomerAccount';
    protected const string CREATE_TRANSACTION_WITH_CUSTOMER = 'EFT/CreateEFTTransactionWithCustomer';
    protected const string CREATE_TRANSACTION = 'EFT/CreateEFTTransaction';
    protected const string SEARCH_TRANSACTION = 'EFT/SearchEFTTransaction';
    protected const string CANCEL_TRANSACTION = 'EFT/CancelEFTTransaction';

    public function __construct(protected EnvClientManager $clientManager)
    {
    }

    public function createCustomer(Requests\CreateCustomer $request): ResponseItem
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::CREATE_CUSTOMER, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseItem::fromArray($result ?? [], Entities\CreatedCustomer::class);
    }

    public function createCustomerAccount(Requests\CreateCustomerAccount $request): ResponseItem
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::CREATE_CUSTOMER_ACCOUNT, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseItem::fromArray($result ?? [], Entities\CreatedCustomerAccount::class);
    }

    public function deleteCustomerAccount(Requests\DeleteCustomerAccount $request): ResponseItem
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::DELETE_CUSTOMER_ACCOUNT, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseItem::fromArray($result ?? [], Entities\ActionConfirmation::class);
    }

    public function searchCustomer(Requests\SearchCustomer $request): ResponseItem
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::SEARCH_CUSTOMER, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseItem::fromArray($result ?? [], Entities\FoundCustomer::class);
    }

    public function searchCustomerAccount(Requests\SearchCustomerAccount $request): ResponseCollection
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::SEARCH_CUSTOMER_ACCOUNT, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseCollection::fromArray($result ?? [], Entities\FoundCustomerAccount::class);
    }

    public function createTransaction(Requests\CreateTransaction $request): ResponseItem
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::CREATE_TRANSACTION, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseItem::fromArray($result ?? [], Entities\CreatedTransaction::class);
    }

    public function searchTransaction(Requests\SearchTransaction $request): ResponseCollection
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::SEARCH_TRANSACTION, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseCollection::fromArray($result ?? [], Entities\FoundTransaction::class);
    }

    public function createTransactionWithCustomer(Requests\CreateTransactionWithCustomer $request): ResponseItem
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::CREATE_TRANSACTION_WITH_CUSTOMER, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseItem::fromArray($result ?? [], Entities\CreatedTransaction::class);
    }

    public function cancelTransaction(Requests\CancelTransaction $request): ResponseItem
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::CANCEL_TRANSACTION, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseItem::fromArray($result ?? [], Entities\ActionConfirmation::class);
    }
}

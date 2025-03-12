<?php

namespace ApiIntegrations\Apaylo\ApiClient;

use ApiIntegrations\Apaylo\DTO\Entities\BillPayments as Entities;
use ApiIntegrations\Apaylo\DTO\Entities\ResponseCollection;
use ApiIntegrations\Apaylo\DTO\Entities\ResponseItem;
use ApiIntegrations\Apaylo\DTO\Requests\BillPayments as Requests;
use ApiIntegrations\Apaylo\Enum\ApiEnv;
use GuzzleHttp\Exception\GuzzleException;

/**
 * @description Apaylo HTTP client
 */
class ClientBillPayments implements ApiClient
{
    protected const string CREATE_BILL_PAYMENT = 'Merchant/CreateBillPayment';
    protected const string SEARCH_PAYEE = 'Merchant/SearchPayee';
    protected const string GET_BILL_PAYMENTS = 'Merchant/GetBillPayments';
    protected const string SEARCH_SEND_BILL_PAYMENTS = 'Merchant/SearchSendBillPayments';

    public function __construct(protected EnvClientManager $clientManager)
    {
    }

    /**
     * @throws GuzzleException
     */
    public function createBillPayment(Requests\CreateBillPayment $request): ResponseItem
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::CREATE_BILL_PAYMENT, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseItem::fromArray($result ?? [], Entities\CreatedBillPayment::class);
    }

    /**
     * @throws GuzzleException
     */
    public function searchPayee(Requests\SearchPayee $request): ResponseItem
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::SEARCH_PAYEE, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseItem::fromArray($result ?? [], Entities\FoundPayee::class);
    }

    /**
     * @throws GuzzleException
     */
    public function getBillPayments(Requests\GetBillPayments $request): ResponseCollection
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::GET_BILL_PAYMENTS, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseCollection::fromArray($result ?? [], Entities\BillPayment::class);
    }

    /**
     * @throws GuzzleException
     */
    public function searchSentBillPayments(Requests\SearchSentBillPayments $request): ResponseCollection
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::SEARCH_SEND_BILL_PAYMENTS, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseCollection::fromArray($result ?? [], Entities\SentBillPayment::class);
    }
}

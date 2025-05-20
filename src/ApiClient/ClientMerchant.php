<?php

namespace ApiIntegrations\Apaylo\ApiClient;

use ApiIntegrations\Apaylo\DTO\Entities\Merchant as Entities;
use ApiIntegrations\Apaylo\DTO\Entities\ResponseCollection;
use ApiIntegrations\Apaylo\DTO\Entities\ResponseItem;
use ApiIntegrations\Apaylo\DTO\Requests\Merchant as Requests;
use ApiIntegrations\Apaylo\Enum\ApiEnv;
use GuzzleHttp\Exception\GuzzleException;

/**
 * @description Apaylo HTTP client
 */
class ClientMerchant implements ApiClient
{
    protected const string HEALTH_CHECK = 'Merchant/HealthCheck';
    protected const string GET_ACTIVITY_REPORT = 'Merchant/GetActivityReport';
    protected const string GET_YESTERDAY_REPORT = 'Merchant/GetYesterdayReport';
    protected const string GET_ALL_TRANSACTIONS = 'Merchant/GetAllTransactions';
    protected const string SEARCH_INTERNAL_TRANSFER = 'Merchant/SearchInternalTransfer';

    public function __construct(protected EnvClientManager $clientManager)
    {
    }

    /**
     * @throws GuzzleException
     *
     * @return ResponseCollection<Entities\ReportTransactionItem>
     */
    public function healthCheck(): ResponseItem
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_1)->get(self::HEALTH_CHECK);
        $result = json_decode((string) $response->getBody(), true);

        return ResponseItem::fromArray($result ?? [], Entities\HealthCheck::class);
    }

    /**
     * @throws GuzzleException
     *
     * @return ResponseCollection<Entities\ReportTransactionItem>
     */
    public function getActivityReport(Requests\GetActivityReport $request): ResponseCollection
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::GET_ACTIVITY_REPORT, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseCollection::fromArray($result ?? [], Entities\ReportTransactionItem::class);
    }

    /**
     * @throws GuzzleException
     *
     * @return ResponseCollection<Entities\ReportTransactionItem>
     */
    public function getYesterdayReport(): ResponseCollection
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->get(self::GET_YESTERDAY_REPORT);
        $result = json_decode((string) $response->getBody(), true);

        return ResponseCollection::fromArray($result ?? [], Entities\ReportTransactionItem::class);
    }

    /**
     * @throws GuzzleException
     *
     * @return ResponseCollection<Entities\NormalizedTransaction>
     */
    public function getAllTransactions(Requests\GetAllTransactions $request): ResponseCollection
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::GET_ALL_TRANSACTIONS, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseCollection::fromArray($result ?? [], Entities\NormalizedTransaction::class);
    }

    /**
     * @throws GuzzleException
     *
     * @return ResponseCollection<Entities\NormalizedTransaction>
     */
    public function searchInternalTransaction(Requests\SearchInternalTransaction $request): ResponseCollection
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::SEARCH_INTERNAL_TRANSFER, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseCollection::fromArray($result ?? [], Entities\NormalizedTransaction::class, 'Result.TransactionDetails');
    }
}

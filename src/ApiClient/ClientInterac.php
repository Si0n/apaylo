<?php

namespace ApiIntegrations\Apaylo\ApiClient;

use ApiIntegrations\Apaylo\DTO\Entities\Interac as Entities;
use ApiIntegrations\Apaylo\DTO\Entities\ResponseCollection;
use ApiIntegrations\Apaylo\DTO\Entities\ResponseItem;
use ApiIntegrations\Apaylo\DTO\Requests\Interac as Requests;
use ApiIntegrations\Apaylo\Enum\ApiEnv;

/**
 * @description Apaylo HTTP client
 */
class ClientInterac implements ApiClient
{
    protected const string SEND_ETRANSFER = 'Merchant/SendInteracEtransfer';
    protected const string GET_INCOMING_TRANSFERS = 'Merchant/GetIncomingTransfers';
    protected const string SEARCH_SENT_ETRANSFER = 'Merchant/SearchSendInteracEtransfer';
    protected const string REQUEST_ETRANSFER_LINK = 'Merchant/RequestInteracEtransferLink';
    protected const string SEARCH_REQUESTED_ETRANSFER = 'Merchant/SearchRequestInteracEtransfer';
    protected const string SEARCH_REQUESTED_ETRANSFER_ARRAY = 'Merchant/SearchRequestInteracEtransferArray';
    protected const string SEARCH_ETRANSFERS = 'Merchant/SearchInteracEtransfers';

    public function __construct(protected EnvClientManager $clientManager)
    {
    }

    /**
     * @api REQUEST E-TRANSFER
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return ResponseItem<Entities\RequestedEtransferLink>
     */
    public function requestEtransferLink(Requests\RequestEtransferLink $request): ResponseItem
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::REQUEST_ETRANSFER_LINK, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseItem::fromArray($result ?? [], Entities\RequestedEtransferLink::class);
    }

    /**
     * @api REQUEST E-TRANSFER
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return ResponseCollection<Entities\FoundRequestedEtransfer>
     */
    public function searchRequestedEtransfer(Requests\SearchRequestedEtransfer $request): ResponseCollection
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::SEARCH_REQUESTED_ETRANSFER, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseCollection::fromArray($result ?? [], Entities\FoundRequestedEtransfer::class);
    }

    /**
     * @api REQUEST E-TRANSFER
     *
     * @deprecated
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return ResponseCollection<Entities\FoundRequestedEtransfer>
     */
    public function searchRequestedEtransferArray(Requests\SearchRequestedEtransferArray $request): ResponseCollection
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::SEARCH_REQUESTED_ETRANSFER_ARRAY, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseCollection::fromArray($result ?? [], Entities\FoundRequestedEtransfer::class);
    }

    /**
     * @api SEND E-TRANSFER
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return ResponseItem<Entities\SentEtransfer>
     */
    public function sendEtransfer(Requests\SendEtransfer $request): ResponseItem
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::SEND_ETRANSFER, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseItem::fromArray($result ?? [], Entities\SentEtransfer::class);
    }

    /**
     * @api SEND E-TRANSFER
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return ResponseCollection<Entities\FoundSentEtransfer>
     */
    public function searchSentEtransfer(Requests\SearchSentEtransfer $request): ResponseCollection
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::SEARCH_SENT_ETRANSFER, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseCollection::fromArray($result ?? [], Entities\FoundSentEtransfer::class);
    }

    /**
     * @api COMPLETED E-TRANSFER
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return ResponseCollection<Entities\CompletedEtransfer>
     */
    public function searchEtransfers(Requests\SearchEtransfers $request): ResponseCollection
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::SEARCH_ETRANSFERS, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseCollection::fromArray($result ?? [], Entities\CompletedEtransfer::class);
    }

    /**
     * @api COMPLETED E-TRANSFER
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return ResponseCollection<Entities\IncomingTransfer>
     */
    public function getIncomingTransfers(Requests\GetIncomingTransfers $request): ResponseCollection
    {
        $response = $this->clientManager->getHttpClient(ApiEnv::ENV_2)->post(self::GET_INCOMING_TRANSFERS, $request->toGuzzleOptions());
        $result = json_decode((string) $response->getBody(), true);

        return ResponseCollection::fromArray($result ?? [], Entities\IncomingTransfer::class);
    }
}

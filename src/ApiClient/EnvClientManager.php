<?php

namespace ApiIntegrations\Apaylo\ApiClient;

use ApiIntegrations\Apaylo\DTO\Entities\General\ApiDomains;
use ApiIntegrations\Apaylo\DTO\Entities\General\AuthCredentials;
use ApiIntegrations\Apaylo\Enum\ApiEnv;
use ApiIntegrations\Apaylo\Middleware\SignatureMiddleware;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use GuzzleHttp\RequestOptions;
use Psr\Log\LoggerInterface;

class EnvClientManager
{
    protected array $httpClients = [];
    protected SignatureMiddleware $authMiddleware;

    public function __construct(
        protected AuthCredentials $authCredentials,
        protected ApiDomains $apiDomains,
        protected ?LoggerInterface $logger = null,
        protected array $defaultOptions = [
            RequestOptions::CONNECT_TIMEOUT => 10,
            RequestOptions::TIMEOUT => 10,
        ],
    ) {
        $this->authMiddleware = new SignatureMiddleware($authCredentials);
    }

    public function getHttpClient(ApiEnv $apiEnv): Client
    {
        if (isset($this->httpClients[$apiEnv->value])) {
            return $this->httpClients[$apiEnv->value];
        }

        $stack = HandlerStack::create();
        if ($this->logger instanceof LoggerInterface) {
            $stack->push(Middleware::log(
                logger: $this->logger,
                formatter: new MessageFormatter(sprintf('apaylo %s {method} {uri} {req_headers} {req_body} >> ({code}:{phrase}) {res_body}', $apiEnv->value)),
            ));
        }
        $stack->push($this->authMiddleware, 'apaylo-signature');

        return $this->httpClients[$apiEnv->value] = new Client([
            'base_uri' => $this->apiDomains->getDomainByEnv($apiEnv),
            'handler' => $stack,
            'http_errors' => false,
            ...$this->defaultOptions,
        ]);
    }
}

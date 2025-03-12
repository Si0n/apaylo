<?php

namespace ApiIntegrations\Apaylo\Middleware;

use ApiIntegrations\Apaylo\DTO\Entities\General\AuthCredentials;
use Psr\Http\Message\RequestInterface;

class SignatureMiddleware
{
    protected ?string $signature = null;

    public function __construct(protected AuthCredentials $credentials)
    {
    }

    public function __invoke(callable $handler): callable
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            if (!$this->signature) {
                $this->signature = $this->generateSignature($this->credentials->apiKey, $this->credentials->sharedSecret);
            }
            if ($this->signature) {
                $request = $request->withHeader('Key', $this->credentials->apiKey);
                $request = $request->withHeader('Signature', $this->signature);
            }

            return $handler($request, $options);
        };
    }

    protected function generateSignature(string $apiKey, string $secretKey): string
    {
        // Create SHA-512 hash
        $hash = hash('sha512', $apiKey . $secretKey . date('Y-m-d'), true);

        // Return the base64 encoded hash
        return base64_encode($hash);
    }
}

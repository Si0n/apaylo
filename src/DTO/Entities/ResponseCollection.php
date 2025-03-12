<?php

namespace ApiIntegrations\Apaylo\DTO\Entities;

/**
 * @template T of ResultEntity
 */
readonly class ResponseCollection
{
    /**
     * @param T[] $result
     */
    public function __construct(
        public ?int $statusCode,
        public ?bool $isError,
        public ?string $message,
        public array $result,
    ) {
    }

    /**
     * @template T of ResultEntity
     *
     * @param class-string<T> $resultClass
     *
     * @return self<T>
     */
    public static function fromArray(array $data, string $resultClass): self
    {
        if (!is_a($resultClass, ResultEntity::class, true)) {
            throw new \InvalidArgumentException('Result class must be an instance of ' . ResultEntity::class);
        }
        $result = $data['Result'] ?? [];
        if (400 === ($data['StatusCode'] ?? null)) {
            $result = [];
        }

        return new self(
            statusCode: $data['StatusCode'] ?? null,
            isError: $data['IsError'] ?? null,
            message: $data['Result']['Message'] ?? null,
            result: array_map($resultClass::fromArray(...), $result),
        );
    }
}

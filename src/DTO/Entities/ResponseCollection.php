<?php

namespace ApiIntegrations\Apaylo\DTO\Entities;

use ApiIntegrations\Apaylo\Utils\Util;

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
     * @param class-string<T> $resultClass
     *
     * @return self<T>
     */
    public static function fromArray(array $data, string $resultClass, string $resultPath = 'Result'): self
    {
        if (!is_a($resultClass, ResultEntity::class, true)) {
            throw new \InvalidArgumentException('Result class must be an instance of ' . ResultEntity::class);
        }
        $result = Util::arrayValue($resultPath, $data);
        if (400 === Util::arrayValue('StatusCode', $data)) {
            $result = [];
        }

        return new self(
            statusCode: Util::arrayValue('StatusCode', $data),
            isError: Util::arrayValue('IsError', $data),
            message: Util::arrayValue('Result.Message', $data),
            result: array_map($resultClass::fromArray(...), $result),
        );
    }
}

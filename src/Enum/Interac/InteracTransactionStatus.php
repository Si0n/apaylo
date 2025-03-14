<?php

namespace ApiIntegrations\Apaylo\Enum\Interac;

enum InteracTransactionStatus: string
{
    case INCOMPLETE = 'Incomplete';
    case PENDING_REQUESTED = 'Pending/Requested';
    case PENDING = 'Pending';
    case REQUESTED = 'Requested';
    case AUTHENTICATED = 'Authenticated';
    case CANCELLED = 'Cancelled';
    case SENT = 'Sent';
    case FULFILLED = 'Fulfilled';
    case COMPLETED = 'Completed';
    case REJECTED = 'Rejected';
    case DECLINED = 'Declined';
    case UNKNOWN = 'Unknown';

    private const string TEXT_INCOMPLETE = 'Incomplete';
    private const string TEXT_PENDING_REQUESTED = 'Pending/Requested';
    private const string TEXT_PENDING = 'Pending';
    private const string TEXT_REQUESTED = 'Requested';
    private const string TEXT_AUTHENTICATED = 'Authenticated';
    private const string TEXT_CANCELLED = 'Cancelled';
    private const string TEXT_SENT = 'Sent';
    private const string TEXT_FULFILLED = 'Fulfilled';
    private const string TEXT_COMPLETED = 'Completed';
    private const string TEXT_REJECTED = 'Rejected';
    private const string TEXT_DECLINED = 'Declined';
    private const string TEXT_UNKNOWN = 'Unknown';

    public const array STATUS_COMPLETED = [
        self::COMPLETED,
        self::FULFILLED,
    ];

    public function isCompleted(): bool
    {
        return in_array($this, self::STATUS_COMPLETED);
    }

    public function getDescription(): string
    {
        return match ($this) {
            self::INCOMPLETE => 'Transaction failed to be created',
            self::PENDING_REQUESTED => 'Transaction has been created/registered',
            self::PENDING => 'Transaction is pending',
            self::REQUESTED => 'Transaction has been requested',
            self::AUTHENTICATED => 'Secret Answer has been properly provided',
            self::CANCELLED => 'Merchant has cancelled the transaction, or the transaction has expired',
            self::SENT => 'Transaction has been sent',
            self::FULFILLED => 'Request was fulfilled, but the funds have not been deposited',
            self::COMPLETED => 'The funds have completed their movement',
            self::REJECTED => 'Transaction was rejected by the recipient',
            self::DECLINED => 'Transaction was declined by the recipient',
            self::UNKNOWN => 'Please wait for updated status',
        };
    }
}

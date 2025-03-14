<?php

namespace ApiIntegrations\Apaylo\Enum\BillPayments;

enum BillPaymentTransactionStatus: string
{
    case INCOMPLETE = 'Incomplete';
    case PAYED = 'Payed';

    public const array STATUS_COMPLETED = [
        self::PAYED,
    ];
}

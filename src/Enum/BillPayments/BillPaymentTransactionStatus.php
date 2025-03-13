<?php

namespace ApiIntegrations\Apaylo\Enum\BillPayments;

enum BillPaymentTransactionStatus: string
{
    case INCOMPLETE = 'Incomplete';
    case PAYED = 'Payed';
}

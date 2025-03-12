<?php

namespace ApiIntegrations\Apaylo\Enum\EFT;

enum TransactionTypeCode: string
{
    case DEBIT = 'D';
    case CREDIT = 'C';
}

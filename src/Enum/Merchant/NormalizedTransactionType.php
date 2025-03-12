<?php

namespace ApiIntegrations\Apaylo\Enum\Merchant;

enum NormalizedTransactionType: string
{
    case EFT = 'EFT';
    case E_TRANSFER = 'E-Transfer';
    case INTERAC = 'Interac';
    case ADMIN = 'Admin';
    case BILL_PAY = 'Bill Pay';
}

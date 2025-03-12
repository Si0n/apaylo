<?php

namespace ApiIntegrations\Apaylo\Enum\Merchant;

enum TransactionType: string
{
    case DEBIT = 'Debit';
    case CREDIT = 'Credit';
}

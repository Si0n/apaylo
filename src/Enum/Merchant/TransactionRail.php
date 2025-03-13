<?php

namespace ApiIntegrations\Apaylo\Enum\Merchant;

enum TransactionRail: string
{
    case EFT = 'EFT';
    case INTERAC = 'Interac';
    case SEND_BILL_PAYMENT = 'SendBillPay';
}

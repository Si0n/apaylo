<?php

namespace ApiIntegrations\Apaylo\Enum;

enum ApiClientType: string
{
    case EFT = 'EFT';
    case INTERAC = 'INTERAC';
    case BILL_PAYMENTS = 'BILL_PAYMENTS';
    case MERCHANT = 'MERCHANT';
}

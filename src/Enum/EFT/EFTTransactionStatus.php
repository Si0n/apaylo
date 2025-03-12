<?php

namespace ApiIntegrations\Apaylo\Enum\EFT;

enum EFTTransactionStatus: string
{
    /**
     * @description Transaction failed to be created
     */
    case INCOMPLETE = 'Incomplete';
    /**
     * @description Transaction has been created
     */
    case PENDING = 'Pending';
    /**
     * @description Merchant has cancelled the transaction
     */
    case CANCELLED = 'Cancelled';
    /**
     * @description Transaction has been sent for processing
     */
    case SENT = 'Sent';
    /**
     * @description The funds have completed their movement
     */
    case SETTLED = 'Settled';
    /**
     * @description Transaction was rejected, likely due to invalid Account information
     */
    case REJECTED = 'Rejected';
    /**
     * @description Please wait for updated status
     */
    case UNKNOWN = 'Unknown';
}

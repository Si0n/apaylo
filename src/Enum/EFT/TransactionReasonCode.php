<?php

namespace ApiIntegrations\Apaylo\Enum\EFT;

enum TransactionReasonCode: int
{
    case EDIT_REJECT = 900;
    case NSF_DEBIT_ONLY = 901;
    case ACCOUNT_NOT_FOUND = 902;
    case PAYMENT_STOPPED_RECALLED = 903;
    case ACCOUNT_CLOSED = 905;
    case NO_DEBIT_ALLOWED = 907;
    case FUNDS_NOT_CLEARED_DEBIT_ONLY = 908;
    case CURRENCY_ACCOUNT_MISMATCH = 909;
    case PAYOR_PAYEE_DECEASED = 910;
    case ACCOUNT_FROZEN = 911;
    case INVALID_INCORRECT_ACCOUNT_NO = 912;
    case INCORRECT_PAYOR_PAYEE_NAME = 914;
    case NO_AGREEMENT_EXISTED = 915;
    case NOT_ACCORDING_TO_AGREEMENT_PERSONAL = 916;
    case AGREEMENT_REVOKED_PERSONAL = 917;
    case NO_CONFIRMATION_PRE_NOTIFICATION_PERSONAL = 918;
    case NOT_ACCORDING_TO_AGREEMENT_BUSINESS = 919;
    case AGREEMENT_REVOKED_BUSINESS = 920;
    case NO_CONFIRMATION_PRE_NOTIFICATION_BUSINESS = 921;
    case CUSTOMER_INITIATED_RETURN_CREDIT_ONLY = 922;
    case INSTITUTION_IN_DEFAULT = 990;

    public function getDescription(): string
    {
        return match ($this) {
            self::EDIT_REJECT, self::INVALID_INCORRECT_ACCOUNT_NO => 'The bank account information provided is invalid',
            self::NSF_DEBIT_ONLY => 'Non Sufficient Funds',
            self::ACCOUNT_NOT_FOUND => 'Account Number is invalid',
            self::PAYMENT_STOPPED_RECALLED => 'Payment was recalled',
            self::ACCOUNT_CLOSED => 'Account is no longer valid',
            self::NO_DEBIT_ALLOWED => 'The Account does not allow for Debit Transactions',
            self::FUNDS_NOT_CLEARED_DEBIT_ONLY => 'Funds available but are currently held by Account Holder’s Financial Institution',
            self::CURRENCY_ACCOUNT_MISMATCH => 'Bank account is not in CAD denomination',
            self::PAYOR_PAYEE_DECEASED => 'Account holder has passed away and the financial institution is preventing debits',
            self::ACCOUNT_FROZEN => 'Financial Institution has frozen the Account',
            self::INCORRECT_PAYOR_PAYEE_NAME => 'Provided Account Holder Name does not match Account Holder name on record',
            self::NO_AGREEMENT_EXISTED => 'PAD agreement was not collected prior to transaction',
            self::NOT_ACCORDING_TO_AGREEMENT_PERSONAL, self::NOT_ACCORDING_TO_AGREEMENT_BUSINESS => 'Transaction is not according to signed PAD agreement',
            self::AGREEMENT_REVOKED_PERSONAL, self::AGREEMENT_REVOKED_BUSINESS => 'PAD Agreement has been revoked',
            self::NO_CONFIRMATION_PRE_NOTIFICATION_PERSONAL, self::NO_CONFIRMATION_PRE_NOTIFICATION_BUSINESS => 'A notification was not provided for upcoming debit transaction',
            self::CUSTOMER_INITIATED_RETURN_CREDIT_ONLY => 'The Account Holder has returned the funds',
            self::INSTITUTION_IN_DEFAULT => 'The Financial Institution is in Default',
        };
    }

    public function getName(): string
    {
        return match ($this) {
            self::EDIT_REJECT => 'Edit Reject',
            self::NSF_DEBIT_ONLY => 'NSF (Debit Only)',
            self::ACCOUNT_NOT_FOUND => 'Account Not Found',
            self::PAYMENT_STOPPED_RECALLED => 'Payment Stopped/Recalled',
            self::ACCOUNT_CLOSED => 'Account Closed',
            self::NO_DEBIT_ALLOWED => 'No Debit Allowed',
            self::FUNDS_NOT_CLEARED_DEBIT_ONLY => 'Funds Not Cleared (Debit Only)',
            self::CURRENCY_ACCOUNT_MISMATCH => 'Currency/Account Mismatch',
            self::PAYOR_PAYEE_DECEASED => 'Payor/Payee Deceased',
            self::ACCOUNT_FROZEN => 'Account Frozen',
            self::INVALID_INCORRECT_ACCOUNT_NO => 'Invalid/Incorrect Account No.',
            self::INCORRECT_PAYOR_PAYEE_NAME => 'Incorrect Payor/Payee Name',
            self::NO_AGREEMENT_EXISTED => 'No Agreement Existed',
            self::NOT_ACCORDING_TO_AGREEMENT_PERSONAL => 'Not According to Agreement - Personal',
            self::AGREEMENT_REVOKED_PERSONAL => 'Agreement Revoked - Personal',
            self::NO_CONFIRMATION_PRE_NOTIFICATION_PERSONAL => 'No Confirmation/Pre-Notification – Personal',
            self::NOT_ACCORDING_TO_AGREEMENT_BUSINESS => 'Not According to Agreement – Business',
            self::AGREEMENT_REVOKED_BUSINESS => 'Agreement Revoked – Business',
            self::NO_CONFIRMATION_PRE_NOTIFICATION_BUSINESS => 'No Confirmation/Pre-Notification – Business',
            self::CUSTOMER_INITIATED_RETURN_CREDIT_ONLY => 'Customer Initiated Return (Credit Only)',
            self::INSTITUTION_IN_DEFAULT => 'Institution in Default',
        };
    }
}

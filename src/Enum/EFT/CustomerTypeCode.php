<?php

namespace ApiIntegrations\Apaylo\Enum\EFT;

enum CustomerTypeCode: string
{
    case PERSON = 'P';
    case CORPORATE = 'C';
}

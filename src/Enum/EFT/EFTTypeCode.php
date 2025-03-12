<?php

namespace ApiIntegrations\Apaylo\Enum\EFT;

/**
 * @description P is for Priority and R is for Regular
 */
enum EFTTypeCode: string
{
    case PRIORITY = 'P';
    case REGULAR = 'R';
}

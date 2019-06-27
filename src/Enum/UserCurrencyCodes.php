<?php

namespace App\Enum;

use Elao\Enum\Enum;
use Elao\Enum\AutoDiscoveredValuesTrait;

final class UserCurrencyCodes extends Enum
{
    use AutoDiscoveredValuesTrait;

    const BITCOIN = 'BTC';
    const ETHEREUM = 'ETH';
    const IOTA = 'IOTA';
}
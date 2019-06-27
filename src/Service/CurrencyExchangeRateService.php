<?php

namespace App\Service;

use App\Service\CurrencyExchangeRate\USDtoBTC;
use App\Service\CurrencyExchangeRate\USDtoETH;
use App\Service\CurrencyExchangeRate\USDtoIOTA;

class CurrencyExchangeRateService {

    private $USDtoBTC;
    private $USDtoETH;
    private $USDtoIOTA;

    function __construct(USDtoBTC $USDtoBTC, USDtoETH $USDtoETH, USDtoIOTA $USDtoIOTA) {
        $this->USDtoBTC = $USDtoBTC;
        $this->USDtoETH = $USDtoETH;
        $this->USDtoIOTA = $USDtoIOTA;
    }

    public function getRate(string $exchangeRateFrom, string $exchangeRateTo) : float
    {
        if ($exchangeRateFrom == "USD" and $exchangeRateTo == "BTC") {
            return $this->USDtoBTC->getRate();
        } elseif ($exchangeRateFrom == "USD" and $exchangeRateTo == "ETH") {
            return $this->USDtoETH->getRate();
        } elseif ($exchangeRateFrom == "USD" and $exchangeRateTo == "IOTA") {
            return $this->USDtoIOTA->getRate();
        } else
            return false;
    }
} 
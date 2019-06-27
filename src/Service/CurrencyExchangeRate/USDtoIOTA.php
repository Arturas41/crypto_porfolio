<?php

namespace App\Service\CurrencyExchangeRate;

class USDtoIOTA implements CurrencyExchangeRateInterface{
    public function getRate() : float
    {
        return 0.447025;
    }
} 
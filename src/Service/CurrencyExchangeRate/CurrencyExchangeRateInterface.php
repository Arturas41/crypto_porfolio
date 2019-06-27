<?php

namespace App\Service\CurrencyExchangeRate;

interface CurrencyExchangeRateInterface{
    public function getRate() : float;
}
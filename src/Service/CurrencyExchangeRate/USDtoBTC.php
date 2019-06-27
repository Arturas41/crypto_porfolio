<?php

namespace App\Service\CurrencyExchangeRate;

class USDtoBTC implements CurrencyExchangeRateInterface{
    public function getRate() : float
    {
        $url='https://api.coingate.com/v2/rates/merchant/USD/BTC';
        return file_get_contents( $url );
    }
} 
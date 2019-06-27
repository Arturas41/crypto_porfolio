<?php

namespace App\Service\CurrencyExchangeRate;

class USDtoETH implements CurrencyExchangeRateInterface{
    public function getRate() : float
    {
        $url='https://api.coingate.com/v2/rates/merchant/USD/ETH';
        return file_get_contents( $url );
    }
} 
<?php
// src/Service/CurrencyConverter.php
namespace App\Service;

use App\Repository\CurrencyExchangeRateRepository;

class CurrencyConverterService
{
    private $repository;

    public function __construct(CurrencyExchangeRateRepository $CurrencyExchangeRateRepository)
    {
        $this->repository = $CurrencyExchangeRateRepository;
    }

    public function convertAllAssetsValues($userAssets, $currencyCodeTo) : Array
    {
        $currencyExchangeRates = $this->repository->findAllLatestByCurrencyCodeFrom($currencyCodeTo);

        $convertedValues = array();

        foreach($userAssets as $key => $value)
        {
            $convertedValues[$value->getId()] = $value->getValue() / $currencyExchangeRates[$value->getCurrency()->getValue()]->getRate();
        }

        return $convertedValues;
    }
}
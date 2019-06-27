<?php

namespace App\Service;


class AssetsService {

    public function totalAssetsValue(CurrencyConverterService $currencyConverterService, $userAssets, $currencyCodeTo) : float
    {
        $totalValue = 0;

        $convertedValues = $currencyConverterService->convertAllAssetsValues($userAssets, $currencyCodeTo);

        return array_sum($convertedValues);
    }

} 
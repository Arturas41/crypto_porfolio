<?php

namespace App\Enum;

use Elao\Enum\Bridge\Doctrine\DBAL\Types\AbstractEnumType;

final class UserCurrencyCodesEnumType extends AbstractEnumType
{
    const NAME = 'userCurrencyCodes';

    protected function getEnumClass(): string
    {
        return UserCurrencyCodes::class;
    }

    public function getName()
    {
        return static::NAME;
    }
}
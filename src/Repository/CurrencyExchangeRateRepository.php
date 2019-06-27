<?php

namespace App\Repository;

use App\Entity\CurrencyExchangeRate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CurrencyExchangeRate|null find($id, $lockMode = null, $lockVersion = null)
 * @method CurrencyExchangeRate|null findOneBy(array $criteria, array $orderBy = null)
 * @method CurrencyExchangeRate[]    findAll()
 * @method CurrencyExchangeRate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrencyExchangeRateRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CurrencyExchangeRate::class);
    }

    public function findAllLatestByCurrencyCodeFrom($currencyCodeFrom)
    {

        return $this->createQueryBuilder('c', 'c.currencyCodeTo')
            ->andWhere('c.currencyCodeFrom = :currency_code_from')
            ->setParameter('currency_code_from', $currencyCodeFrom)
            ->orderBy('c.updated', 'DESC')
            ->groupBy('c.currencyCodeTo')
            ->getQuery()
            ->getResult();
        ;
    }
}

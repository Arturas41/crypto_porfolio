<?php
// src/Command/UpdateExchangeRatesCommand.php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use App\Entity\CurrencyExchangeRate;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\CurrencyExchangeRateService;

class UpdateCurrencyExchangeRatesCommand extends Command
{
    protected static $defaultName = 'app:update-currency-exchange-rates';

    private $entityManager;

    private $currencyExchangeRateService;

    public function __construct(EntityManagerInterface $entityManager,CurrencyExchangeRateService $currencyExchangeRateService) {
        $this->entityManager = $entityManager;

        $this->currencyExchangeRateService = $currencyExchangeRateService;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Update currency_exchange_rate	database table from external sources');

        $this->addArgument('exchangeRateFrom', InputArgument::REQUIRED, 'Exchange rate from');

        $this->addArgument('exchangeRateTo', InputArgument::REQUIRED, 'Exchange rate to');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('exchangeRateFrom: '.$input->getArgument('exchangeRateFrom'));
        $output->writeln('exchangeRateTo: '.$input->getArgument('exchangeRateTo'));

        $currencyExchangeRate = new CurrencyExchangeRate();

        $rate = $this->currencyExchangeRateService->getRate($input->getArgument('exchangeRateFrom'),$input->getArgument('exchangeRateTo'));

        if($rate !== false){
            $currencyExchangeRate->setCurrencyCodeFrom($input->getArgument('exchangeRateFrom'));
            $currencyExchangeRate->setCurrencyCodeTo($input->getArgument('exchangeRateTo'));
            $currencyExchangeRate->setRate($rate);
            $currencyExchangeRate->setUpdated(new \DateTime());

            $this->entityManager->persist($currencyExchangeRate);
            $this->entityManager->flush();
        }
    }
}
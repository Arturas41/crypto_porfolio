<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CurrencyExchangeRateRepository")
 */
class CurrencyExchangeRate
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $currencyCodeFrom;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $currencyCodeTo;

    /**
     * @ORM\Column(type="float")
     */
    private $rate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCurrencyCodeFrom(): ?string
    {
        return $this->currencyCodeFrom;
    }

    public function setCurrencyCodeFrom(string $currencyCodeFrom): self
    {
        $this->currencyCodeFrom = $currencyCodeFrom;

        return $this;
    }

    public function getCurrencyCodeTo(): ?string
    {
        return $this->currencyCodeTo;
    }

    public function setCurrencyCodeTo(string $currencyCodeTo): self
    {
        $this->currencyCodeTo = $currencyCodeTo;

        return $this;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(float $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }
}

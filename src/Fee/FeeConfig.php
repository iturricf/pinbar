<?php

declare(strict_types=1);

namespace CharlieIndia\Pinbar\Fee;

/**
 * @author Cristian Iturri <iturri.cf@gmail.com>
 */
class FeeConfig implements FeeConfigInterface
{
    private $name;
    private $minAmount;
    private $feeRate;
    private $marketFeeRate;
    private $taxRate;

    public function __construct(array $config)
    {
        $this->parseConfig($config);
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getFeeMinAmount(): float
    {
        return $this->minAmount;
    }

    /**
     * {@inheritdoc}
     */
    public function getFeeRate(): float
    {
        return $this->feeRate;
    }

    /**
     * {@inheritdoc}
     */
    public function getMarketFeeRate(): float
    {
        return $this->marketFeeRate;
    }

    /**
     * {@inheritdoc}
     */
    public function getTaxRate(): float
    {
        return $this->taxRate;
    }

    private function parseConfig(array $config)
    {
        if (!isset($config['name'])) {
            throw new \OutOfBoundsException('Invalid name for fee configuration.');
        }

        if (!isset($config['min_amount'])) {
            throw new \OutOfBoundsException('Invalid name for fee configuration.');
        }

        if (!isset($config['fee_rate'])) {
            throw new \OutOfBoundsException('Invalid name for fee configuration.');
        }

        if (!isset($config['market_fee_rate'])) {
            throw new \OutOfBoundsException('Invalid name for fee configuration.');
        }

        if (!isset($config['tax_rate'])) {
            $this->taxRate = floatval(0.21);
        } else {
            $this->taxRate = floatval($config['tax_rate']);
        }

        $this->name = $config['name'];
        $this->minAmount = $config['min_amount'];
        $this->feeRate = $config['fee_rate'];
        $this->marketFeeRate = $config['market_fee_rate'];
    }
}

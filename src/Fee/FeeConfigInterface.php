<?php

declare(strict_types=1);

namespace CharlieIndia\Pinbar\Fee;

/**
 * @author Cristian Iturri <iturri.cf@gmail.com>
 */
interface FeeConfigInterface
{
    /**
     * Returns the fee config name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Returns the fee minimum amount
     *
     * @return float
     */
    public function getFeeMinAmount(): float;

    /**
     * Returns the fee general rate
     *
     * @return float;
     */
    public function getFeeRate(): float;

    /**
     * Returns the market fee rate
     *
     * @return float
     */
    public function getMarketFeeRate(): float;

    /**
     * Returns the tax rate
     *
     * @return float
     */
    public function getTaxRate(): float;
}

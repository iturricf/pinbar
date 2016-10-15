<?php

namespace CharlieIndia\Pinbar\Calculator;

use CharlieIndia\Pinbar\Operation\Operation;

class Calculator
{
    const RATE_SILVER_FEE = 0.007;
    const RATE_SILVER_MIN_FEE = 50;
    const RATE_MARKET_FEE = 0.0008;
    const RATE_TAX = 0.21;

    public function simulateAmount(float $amount, float $price, int $opType = Operation::TYPE_BUY): Operation
    {
        $op = new Operation($opType);
        $op->setPrice($price);
        $op->setQuantity(floor($amount / $price));

        $fee = $op->getOperationTotal(false) * self::RATE_SILVER_FEE;
        $fee = $fee > self::RATE_SILVER_MIN_FEE ? $fee : self::RATE_SILVER_MIN_FEE;

        $marketFee = $op->getOperationTotal(false) * self::RATE_MARKET_FEE;

        $op->setFee($fee);
        $op->setFeeTax($fee * self::RATE_TAX);
        $op->setMarketFee($marketFee);
        $op->setMarketFeeTax($marketFee * self::RATE_TAX);

        return $op;
    }

    public function simulateQuantity(int $quantity, float $price, int $opType = Operation::TYPE_BUY): Operation
    {
        $op = new Operation();

    }
}

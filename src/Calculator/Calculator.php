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

        $this->calcFees($op);

        return $op;
    }

    public function simulateQuantity(int $quantity, float $price, int $opType = Operation::TYPE_BUY): Operation
    {
        $op = new Operation($opType);
        $op->setPrice($price);
        $op->setQuantity($quantity);

        $this->calcFees($op);

        return $op;
    }

    public function simulateBullish(Operation $op, float $delta): Operation
    {
        $feeRatio = ($op->getTotal() - $op->getAmount()) / $op->getAmount();

        $priceVariation = (($op->getPrice() * (1 + $feeRatio)) / (1 - $feeRatio)) - $op->getPrice();

        $sellOp = new Operation(Operation::TYPE_SELL);
        $sellOp->setPrice($op->getPrice() + $priceVariation);
        $sellOp->setQuantity($op->getQuantity());

        $this->calcFees($sellOp);

        return $sellOp;
    }

    private function calcFees(Operation $op)
    {
        $op->setFee($this->calcFee($op));
        $op->setFeeTax($op->getFee() * self::RATE_TAX);
        $op->setMarketFee($this->calcMarketFee($op));
        $op->setMarketFeeTax($op->getMarketFee() * self::RATE_TAX);
    }

    private function calcFee(Operation $op): float
    {
        $fee = $op->getAmount() * self::RATE_SILVER_FEE;

        return $fee > self::RATE_SILVER_MIN_FEE ? $fee : self::RATE_SILVER_MIN_FEE;
    }

    private function calcMarketFee(Operation $op): float
    {
        return $op->getAmount() * self::RATE_MARKET_FEE;
    }
}

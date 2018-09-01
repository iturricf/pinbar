<?php

declare(strict_types=1);

namespace CharlieIndia\Pinbar\Calculator;

use CharlieIndia\Pinbar\Fee\FeeConfigInterface;
use CharlieIndia\Pinbar\Operation\Operation;

/**
 * @author Cristian Iturri <iturri.cf@gmail.com>
 */
class Calculator
{
    private $fees;

    public function __construct(FeeConfigInterface $fees)
    {
        $this->fees = $fees;
    }

    public function simulateAmount(float $amount, float $price, int $opType = Operation::TYPE_BUY): Operation
    {
        $op = new Operation($opType);
        $op->setPrice($price);
        $op->setQuantity((int) floor($amount / $price));

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

    public function simulateBullish(Operation $op, float $profit): Operation
    {
        $feeRatio = ($op->getTotal() - $op->getAmount()) / $op->getAmount();

        $feeEquation = 1 + $feeRatio;

        $priceVariation = (($op->getPrice() * ($feeEquation + $profit * $feeEquation)) / (1 - $feeRatio)) - $op->getPrice();

        $sellOp = new Operation(Operation::TYPE_SELL);
        $sellOp->setPrice($op->getPrice() + $priceVariation);
        $sellOp->setQuantity($op->getQuantity());

        $this->calcFees($sellOp);

        return $sellOp;
    }

    private function calcFees(Operation $op)
    {
        $op->setFee($this->calcFee($op));
        $op->setFeeTax($op->getFee() * $this->fees->getTaxRate());
        $op->setMarketFee($this->calcMarketFee($op));
        $op->setMarketFeeTax($op->getMarketFee() * $this->fees->getTaxRate());
    }

    private function calcFee(Operation $op): float
    {
        $fee = $op->getAmount() * $this->fees->getFeeRate();

        return $fee > $this->fees->getFeeMinAmount() ? $fee : $this->fees->getFeeMinAmount();
    }

    private function calcMarketFee(Operation $op): float
    {
        return $op->getAmount() * $this->fees->getMarketFeeRate();
    }
}

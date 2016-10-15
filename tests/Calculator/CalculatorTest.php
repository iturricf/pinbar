<?php

namespace CharlieIndia\Pinbar\Tests\Calculator;

use CharlieIndia\Pinbar\Calculator\Calculator;
use CharlieIndia\Pinbar\Operation\Operation;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends Testcase
{
    public function testSimulateAmount()
    {
        $calc = new Calculator();
        $op = $calc->simulateAmount(3000, 109.4);

        $this->assertEquals($op->getOperationTotal(false), 2953.80);
        $this->assertEquals($op->getOperationTotal(), 3017.16);

        $op = $calc->simulateAmount(3100, 152);

        $this->assertEquals($op->getOperationTotal(false), 3040);
        $this->assertEquals($op->getOperationTotal(), 3103.44);

        $op = $calc->simulateQuantity(10, 160);

        $this->assertEquals($op->getOperationTotal(false), 1600);
        $this->assertEquals($op->getOperationTotal(), 1662.05);

        $op = $calc->simulateQuantity(27, 98, Operation::TYPE_SELL);

        $this->assertEquals($op->getOperationTotal(false), 2646);
        $this->assertEquals($op->getOperationTotal(), 2582.94);

        $op = $calc->simulateQuantity(10, 178, Operation::TYPE_SELL);

        $this->assertEquals($op->getOperationTotal(false), 1780);
        $this->assertEquals($op->getOperationTotal(), 1717.78);
    }
}

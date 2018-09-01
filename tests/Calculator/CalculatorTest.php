<?php

declare(strict_types=1);

namespace CharlieIndia\Pinbar\Tests\Calculator;

use CharlieIndia\Pinbar\Calculator\Calculator;
use CharlieIndia\Pinbar\Fee\FeeConfig;
use CharlieIndia\Pinbar\Operation\Operation;
use PHPUnit\Framework\TestCase;

/**
 * @author Cristian Iturri <iturri.cf@gmail.com>
 */
class CalculatorTest extends TestCase
{
    private $calc;

    protected function setUp()
    {
        $feeConfig = new FeeConfig([
            'name' => 'IOL',
            'min_amount' => 50,
            'fee_rate' => 0.007,
            'market_fee_rate' => 0.0008,
            'tax_rate' => 0.21,
        ]);

        $this->calc = new Calculator($feeConfig);
    }

    public function testSimulateAmount()
    {
        $op = $this->calc->simulateAmount(3000, 109.4);

        $this->assertEquals($op->getAmount(), 2953.80);
        $this->assertEquals($op->getTotal(), 3017.16);

        $op = $this->calc->simulateAmount(3100, 152);

        $this->assertEquals($op->getAmount(), 3040);
        $this->assertEquals($op->getTotal(), 3103.44);

        $op = $this->calc->simulateQuantity(10, 160);

        $this->assertEquals($op->getAmount(), 1600);
        $this->assertEquals($op->getTotal(), 1662.05);

        $op = $this->calc->simulateQuantity(27, 98, Operation::TYPE_SELL);

        $this->assertEquals($op->getAmount(), 2646);
        $this->assertEquals($op->getTotal(), 2582.94);

        $op = $this->calc->simulateQuantity(10, 178, Operation::TYPE_SELL);

        $this->assertEquals($op->getAmount(), 1780);
        $this->assertEquals($op->getTotal(), 1717.78);
    }

    /**
     * @expectedException \DomainException
     */
    public function testSimulateAmountException()
    {
        $op = $this->calc->simulateAmount(10, 178);
    }
}

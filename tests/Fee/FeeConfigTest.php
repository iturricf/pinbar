<?php

declare(strict_types=1);

namespace CharlieIndia\Pinbar\Tests\Fee;

use CharlieIndia\Pinbar\Fee\FeeConfig;
use PHPUnit\Framework\TestCase;

/**
 * @author Cristian Iturri <iturri.cf@gmail.com>
 */
class FeeConfigTest extends TestCase
{
    private $config;
    private $noNameConfig;
    private $noMinAmountConfig;
    private $noFeeRateConfig;
    private $noMarketFeeRateConfig;
    private $noTaxConfig;
    private $feeConfig;

    protected function setUp()
    {
        $this->config = [
            'name' => 'IOL',
            'min_amount' => 50,
            'fee_rate' => 0.007,
            'market_fee_rate' => 0.0008,
            'tax_rate' => 0.13,
        ];

        $this->noNameConfig = [
            'min_amount' => 50,
            'fee_rate' => 0.007,
            'market_fee_rate' => 0.0008,
            'tax_rate' => 0.13,
        ];

        $this->noMinAmountConfig = [
            'name' => 'IOL',
            'fee_rate' => 0.007,
            'market_fee_rate' => 0.0008,
            'tax_rate' => 0.13,
        ];

        $this->noFeeRateConfig = [
            'name' => 'IOL',
            'min_amount' => 50,
            'market_fee_rate' => 0.0008,
            'tax_rate' => 0.13,
        ];

        $this->noMarketFeeRateConfig = [
            'name' => 'IOL',
            'min_amount' => 50,
            'fee_rate' => 0.007,
            'tax_rate' => 0.13,
        ];

        $this->noTaxConfig = [
            'name' => 'IOL',
            'min_amount' => 50,
            'fee_rate' => 0.007,
            'market_fee_rate' => 0.0008,
        ];

        $this->feeConfig = new FeeConfig($this->config);
    }

    public function testConstructor()
    {
        $feeConfig = new FeeConfig($this->config);
        $badConfig = new FeeConfig($this->noTaxConfig);
    }

    /**
     * @expectedException \OutOfBoundsException
     */
    public function testNoNameConfig()
    {
        $badConfig = new FeeConfig($this->noNameConfig);
    }

    /**
     * @expectedException \OutOfBoundsException
     */
    public function testNoMinAmountConfig()
    {
        $badConfig = new FeeConfig($this->noMinAmountConfig);
    }

    /**
     * @expectedException \OutOfBoundsException
     */
    public function testNoFeeRateConfig()
    {
        $badConfig = new FeeConfig($this->noFeeRateConfig);
    }

    /**
     * @expectedException \OutOfBoundsException
     */
    public function testNoMarketFeeRateConfig()
    {
        $badConfig = new FeeConfig($this->noMarketFeeRateConfig);
    }

    public function testGetName()
    {
        $this->assertEquals($this->config['name'], $this->feeConfig->getName());
    }

    public function testGetFeeMinAmount()
    {
        $this->assertEquals($this->config['min_amount'], $this->feeConfig->getFeeMinAmount());
    }

    public function testGetFeeRate()
    {
        $this->assertEquals($this->config['fee_rate'], $this->feeConfig->getFeeRate());
    }

    public function testGetMarketFeeRate()
    {
        $this->assertEquals($this->config['market_fee_rate'], $this->feeConfig->getMarketFeeRate());
    }

    public function testGetTaxRate()
    {
        $this->assertEquals($this->config['tax_rate'], $this->feeConfig->getTaxRate());

        $feeConfig = new FeeConfig($this->noTaxConfig);

        $this->assertEquals(0.21, $feeConfig->getTaxRate(), null, 0.001);
    }
}

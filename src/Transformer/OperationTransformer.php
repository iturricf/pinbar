<?php

declare(strict_types=1);

namespace CharlieIndia\Pinbar\Transformer;

/**
 * @author Cristian Iturri <iturri.cf@gmail.com>
 */
class OperationTransformer implements TransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($operation)
    {
        return [
            'quantity' => $operation->getQuantity(),
            'price' => round($operation->getPrice(), 2),
            'amount' => $operation->getAmount(),
            'total' => $operation->getTotal(),
            'fee' => [
                'total' => round($operation->getFee() + $operation->getFeeTax() + $operation->getMarketFee() + $operation->getMarketFeeTax(), 2),
                'trx_fee' => [
                    'fee_amount' => $operation->getFee(),
                    'tax_amount' => $operation->getFeeTax(),
                ],
                'market_fee' => [
                    'fee_amount' => $operation->getMarketFee(),
                    'tax_amount' => $operation->getMarketFeeTax(),
                ],
            ],
        ];
    }
}

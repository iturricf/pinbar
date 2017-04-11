<?php

declare(strict_types=1);

namespace CharlieIndia\Pinbar\Output;

use CharlieIndia\Pinbar\Operation\Operation;
use CharlieIndia\Pinbar\Transformer\OperationTransformer;

class VerboseOutputManager implements OutputManagerInterface
{
    private $transformer;

    public function __construct(OperationTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * {@inheritdoc}
     */
    public function print(Operation $operation)
    {
        $op = $this->transformer->transform($operation);

        $output = "Cantidad:\t%d\nPrecio limite:\tAR$ %.2f\nMonto estimado:\tAR$ %.2f\n"
        . "Comision:\tAR$ %.2f\n"
        . "Impuestos:\tAR$ %.2f*\n"
        . "\tIVA Comision: AR$ %.2f\n"
        . "\tDerecho de mercado: AR$ %.2f\n"
        . "\nTOTAL:\t\tAR$ %.2f\n";

        printf($output,
            $op['quantity'],
            $op['price'],
            $op['amount'],
            $op['fee']['trx_fee']['fee_amount'],
            $op['fee']['trx_fee']['tax_amount'] + $op['fee']['market_fee']['fee_amount'] + $op['fee']['market_fee']['tax_amount'],
            $op['fee']['trx_fee']['tax_amount'],
            $op['fee']['market_fee']['fee_amount'] + $op['fee']['market_fee']['tax_amount'],
            $op['total']);
    }
}

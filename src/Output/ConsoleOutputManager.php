<?php

declare(strict_types=1);

namespace CharlieIndia\Pinbar\Output;

use CharlieIndia\Pinbar\Operation\Operation;
use CharlieIndia\Pinbar\Transformer\OperationTransformer;

class ConsoleOutputManager implements OutputManagerInterface
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

        $output = ($operation->getType() > 0 ? 'Compra ' : 'Vende ') . "%d papeles a AR$ %.2f con Comision de AR$ %.2f. Total AR$ %.2f\n\n";

        printf($output,
            $op['quantity'],
            $op['price'],
            $op['fee']['total'],
            $op['total']);
    }
}

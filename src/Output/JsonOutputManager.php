<?php

declare(strict_types=1);

namespace CharlieIndia\Pinbar\Output;

use CharlieIndia\Pinbar\Operation\Operation;
use CharlieIndia\Pinbar\Transformer\OperationTransformer;

class JsonOutputManager implements OutputManagerInterface
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
        printf(json_encode($this->transformer->transform($operation), JSON_PRETTY_PRINT));
    }
}

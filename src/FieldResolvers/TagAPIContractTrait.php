<?php

declare(strict_types=1);

namespace PoP\Tags\FieldResolvers;

trait TagAPIContractTrait
{
    abstract protected function getTypeAPI(): \PoP\Tags\FunctionAPI;
    abstract protected function getTypeResolverClass(): string;
    protected function getObjectPropertyAPI(): \PoP\Tags\ObjectPropertyResolver
    {
        $cmstagsresolver = \PoP\Tags\ObjectPropertyResolverFactory::getInstance();
        return $cmstagsresolver;
    }
}

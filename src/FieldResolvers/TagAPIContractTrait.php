<?php

declare(strict_types=1);

namespace PoP\Tags\FieldResolvers;

trait TagAPIContractTrait
{
    abstract protected function getTypeAPI();
    abstract protected function getTypeResolverClass(): string;
    abstract protected function getObjectPropertyAPI();
}

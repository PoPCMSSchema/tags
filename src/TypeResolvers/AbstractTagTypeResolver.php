<?php

declare(strict_types=1);

namespace PoP\Tags\TypeResolvers;

use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\ComponentModel\TypeResolvers\AbstractTypeResolver;
use PoP\Tags\ComponentContracts\TagAPIRequestedContractTrait;

abstract class AbstractTagTypeResolver extends AbstractTypeResolver
{
    use TagAPIRequestedContractTrait;

    public function getSchemaTypeDescription(): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        return $translationAPI->__('Representation of a tag, added to a custo post', 'tags');
    }

    public function getID($resultItem)
    {
        $cmstagsresolver = $this->getObjectPropertyAPI();
        $tag = $resultItem;
        return $cmstagsresolver->getTagID($tag);
    }
}

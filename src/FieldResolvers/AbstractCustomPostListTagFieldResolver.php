<?php

declare(strict_types=1);

namespace PoP\Tags\FieldResolvers;

use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\CustomPosts\FieldResolvers\AbstractCustomPostListFieldResolver;
use PoP\Tags\TypeResolvers\TagTypeResolver;

abstract class AbstractCustomPostListTagFieldResolver extends AbstractCustomPostListFieldResolver
{
    use TagAPIContractTrait;

    public function getSchemaFieldDescription(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        $descriptions = [
            'customPosts' => $translationAPI->__('Custom posts which contain this tag', 'pop-tags'),
            'customPostCount' => $translationAPI->__('Number of custom posts which contain this tag', 'pop-tags'),
        ];
        return $descriptions[$fieldName] ?? parent::getSchemaFieldDescription($typeResolver, $fieldName);
    }

    abstract protected function getQueryProperty(): string;

    protected function getQuery(TypeResolverInterface $typeResolver, $resultItem, string $fieldName, array $fieldArgs = []): array
    {
        $query = parent::getQuery($typeResolver, $resultItem, $fieldName, $fieldArgs);

        $tag = $resultItem;
        switch ($fieldName) {
            case 'customPosts':
            case 'customPostCount':
                $query[$this->getQueryProperty()] = [$typeResolver->getID($tag)];
                break;
        }

        return $query;
    }
}

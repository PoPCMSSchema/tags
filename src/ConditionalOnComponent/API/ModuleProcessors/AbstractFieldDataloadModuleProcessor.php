<?php

declare(strict_types=1);

namespace PoPSchema\Tags\ConditionalOnComponent\API\ModuleProcessors;

use PoP\API\ModuleProcessors\AbstractRelationalFieldDataloadModuleProcessor;
use PoP\ComponentModel\QueryInputOutputHandlers\ListQueryInputOutputHandler;
use PoPSchema\QueriedObject\ModuleProcessors\QueriedDBObjectModuleProcessorTrait;
use PoPSchema\PostTags\TypeResolvers\Object\PostTagTypeResolver;
use PoPSchema\Tags\ModuleProcessors\TagFilterInputContainerModuleProcessor;

abstract class AbstractFieldDataloadModuleProcessor extends AbstractRelationalFieldDataloadModuleProcessor
{
    use QueriedDBObjectModuleProcessorTrait;

    public const MODULE_DATALOAD_RELATIONALFIELDS_TAG = 'dataload-relationalfields-tag';
    public const MODULE_DATALOAD_RELATIONALFIELDS_TAGLIST = 'dataload-relationalfields-taglist';
    public const MODULE_DATALOAD_RELATIONALFIELDS_TAGCOUNT = 'dataload-relationalfields-tagcount';

    public function getModulesToProcess(): array
    {
        return array(
            [self::class, self::MODULE_DATALOAD_RELATIONALFIELDS_TAG],
            [self::class, self::MODULE_DATALOAD_RELATIONALFIELDS_TAGLIST],
            [self::class, self::MODULE_DATALOAD_RELATIONALFIELDS_TAGCOUNT],
        );
    }

    public function getDBObjectIDOrIDs(array $module, array &$props, &$data_properties): string | int | array
    {
        switch ($module[1]) {
            case self::MODULE_DATALOAD_RELATIONALFIELDS_TAG:
                return $this->getQueriedDBObjectID($module, $props, $data_properties);
        }

        return parent::getDBObjectIDOrIDs($module, $props, $data_properties);
    }

    public function getRelationalTypeResolverClass(array $module): ?string
    {
        switch ($module[1]) {
            case self::MODULE_DATALOAD_RELATIONALFIELDS_TAG:
            case self::MODULE_DATALOAD_RELATIONALFIELDS_TAGLIST:
                return PostTagTypeResolver::class;
        }

        return parent::getRelationalTypeResolverClass($module);
    }

    public function getQueryInputOutputHandlerClass(array $module): ?string
    {
        switch ($module[1]) {
            case self::MODULE_DATALOAD_RELATIONALFIELDS_TAGLIST:
                return ListQueryInputOutputHandler::class;
        }

        return parent::getQueryInputOutputHandlerClass($module);
    }

    public function getFilterSubmodule(array $module): ?array
    {
        switch ($module[1]) {
            case self::MODULE_DATALOAD_RELATIONALFIELDS_TAGLIST:
                return [TagFilterInputContainerModuleProcessor::class, TagFilterInputContainerModuleProcessor::MODULE_FILTERINPUTCONTAINER_TAGS];
            case self::MODULE_DATALOAD_RELATIONALFIELDS_TAGCOUNT:
                return [TagFilterInputContainerModuleProcessor::class, TagFilterInputContainerModuleProcessor::MODULE_FILTERINPUTCONTAINER_TAGCOUNT];
        }

        return parent::getFilterSubmodule($module);
    }
}

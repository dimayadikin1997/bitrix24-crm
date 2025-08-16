<?php

declare(strict_types=1);

namespace Yadikin\Bitrix24\Crm\Action\Intefaces;

use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionFactoryInteface;
use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionCollectionInteface;
use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionParamsInteface;
use Yadikin\Bitrix24\Crm\Factory\Intefaces\FactoryInteface;
use Yadikin\Bitrix24\Crm\Action\Support\ActionOperation;
use Yadikin\Bitrix24\Crm\Action\Support\EventOperation;

/**
 * @author dimay
 */
interface ActionRegistryInteface 
{
    /**
     * @param type $class
     * @param string|null $method
     * @param ActionParamsInteface|null $params
     * @param FactoryInteface|null $factory
     * @return ActionRegistryInteface
     */
    public function onBeforeAdd($class, ?string $method = null, ?ActionParamsInteface $params = null, ?FactoryInteface $factory = null) : ActionRegistryInteface;
    
    /**
     * @param type $class
     * @param string|null $method
     * @param ActionParamsInteface|null $params
     * @param FactoryInteface|null $factory
     * @return ActionRegistryInteface
     */
    public function onAfterAdd($class, ?string $method = null, ?ActionParamsInteface $params = null, ?FactoryInteface $factory = null) : ActionRegistryInteface;
    
    /**
     * @param type $class
     * @param string|null $method
     * @param ActionParamsInteface|null $params
     * @param FactoryInteface|null $factory
     * @return ActionRegistryInteface
     */
    public function onBeforeUpdate($class, ?string $method = null, ?ActionParamsInteface $params = null, ?FactoryInteface $factory = null) : ActionRegistryInteface;
    
    /**
     * @param type $class
     * @param string|null $method
     * @param ActionParamsInteface|null $params
     * @param FactoryInteface|null $factory
     * @return ActionRegistryInteface
     */
    public function onAfterUpdate($class, ?string $method = null, ?ActionParamsInteface $params = null, ?FactoryInteface $factory = null) : ActionRegistryInteface;
    
    /**
     * @param type $class
     * @param string|null $method
     * @param ActionParamsInteface|null $params
     * @param FactoryInteface|null $factory
     * @return ActionRegistryInteface
     */
    public function onBeforeDelete($class, ?string $method = null, ?ActionParamsInteface $params = null, ?FactoryInteface $factory = null) : ActionRegistryInteface;
    
    /**
     * @param type $class
     * @param string|null $method
     * @param ActionParamsInteface|null $params
     * @param FactoryInteface|null $factory
     * @return ActionRegistryInteface
     */
    public function onAfterDelete($class, ?string $method = null, ?ActionParamsInteface $params = null, ?FactoryInteface $factory = null) : ActionRegistryInteface;
    
    /**
     * @param FactoryInteface $factory
     * @param type $class
     * @param string|null $method
     * @param ActionOperation $actionOperation
     * @param EventOperation $eventOperation
     * @param ActionParamsInteface|null $params
     * @return ActionRegistryInteface
     */
    public function on(FactoryInteface $factory, $class, ?string $method = null, ActionOperation $actionOperation, EventOperation $eventOperation, ?ActionParamsInteface $params = null) : ActionRegistryInteface;
    
    /**
     * @param FactoryInteface|null $factory
     * @return ActionCollectionInteface
     */
    public function getOnBeforeAdd(?FactoryInteface $factory = null) : ActionCollectionInteface;
    
    /**
     * @param FactoryInteface|null $factory
     * @return ActionCollectionInteface
     */
    public function getOnAfterAdd(?FactoryInteface $factory = null) : ActionCollectionInteface;
    
    /**
     * @param FactoryInteface|null $factory
     * @return ActionCollectionInteface
     */
    public function getOnBeforeUpdate(?FactoryInteface $factory = null) : ActionCollectionInteface;
    
    /**
     * @param FactoryInteface|null $factory
     * @return ActionCollectionInteface
     */
    public function getOnAfterUpdate(?FactoryInteface $factory = null) : ActionCollectionInteface;
    
    /**
     * @param FactoryInteface|null $factory
     * @return ActionCollectionInteface
     */
    public function getOnBeforeDelete(?FactoryInteface $factory = null) : ActionCollectionInteface;
    
    /**
     * @param FactoryInteface|null $factory
     * @return ActionCollectionInteface
     */
    public function getOnAfterDelete(?FactoryInteface $factory = null) : ActionCollectionInteface;
    
    /**
     * @param FactoryInteface $factory
     * @param ActionOperation $actionOperation
     * @param EventOperation $eventOperation
     * @return ActionCollectionInteface
     */
    public function getOn(FactoryInteface $factory, ActionOperation $actionOperation, EventOperation $eventOperation) : ActionCollectionInteface;
    
    /**
     * @return ActionCollectionInteface
     */
    public function getFactoryCollection() : ActionCollectionInteface;
    
    /**
     * @param FactoryInteface $factory
     * @return ActionRegistryInteface
     */
    public function setFactory(FactoryInteface $factory) : ActionRegistryInteface;
    
    /**
     * @return FactoryInteface
     */
    public function getFactory() : FactoryInteface;
    
    /**
     * @param ActionFactoryInteface $actionFactory
     * @return ActionRegistryInteface
     */
    public function setActionFactory(ActionFactoryInteface $actionFactory) : ActionRegistryInteface;
    
    /**
     * @return ActionFactoryInteface
     */
    public function getActionFactory() : ActionFactoryInteface;
}

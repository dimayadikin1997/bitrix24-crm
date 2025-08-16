<?php

declare(strict_types=1);

namespace Yadikin\Bitrix24\Crm\Action;

use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionRegistryInteface;
use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionFactoryInteface;
use Yadikin\Bitrix24\Crm\Factory\Intefaces\FactoryInteface;
use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionCollectionInteface;
use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionParamsInteface;
use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionInteface;


use Yadikin\Bitrix24\Crm\Action\Support\ActionOperation;
use Yadikin\Bitrix24\Crm\Action\Support\EventOperation;
use Yadikin\Bitrix24\Crm\Action\Support\SortOperation;
use Yadikin\Bitrix24\Crm\Action\ActionFactory;

/**
 * Description of Actions
 *
 * @author dimay
 */
class Actions implements ActionRegistryInteface
{
    /** @var ActionCollectionInteface[] */
    protected static array $actions = [];
    
    /** @var ActionInteface */
    protected ?ActionInteface $last = null;
    
    /** @var FactoryInteface|null */
    protected ?FactoryInteface $factory = null;
    
    /** @var FactoryInteface|null */
    protected ?ActionFactoryInteface $actionFactory = null;
        
    public function __construct(ActionFactoryInteface $actionFactory)
    {
        $this->setActionFactory($actionFactory);
    }
      
    /**
     * @return ActionRegistryInteface
     */
    public static function getInstance(?ActionFactoryInteface $actionFactory = null) : ActionRegistryInteface
    {
        if (!($actionFactory instanceof ActionFactoryInteface))
        {
            $actionFactory = new ActionFactory();
        }
        
        return new static($actionFactory);
    }
    
    /**
     * @return ActionRegistryInteface
     */
    public static function make(?FactoryInteface $factory = null, ?ActionFactoryInteface $actionFactory = null) : ActionRegistryInteface
    {
        $actions = static::getInstance($actionFactory);
        
        if ($factory instanceof FactoryInteface)
        {
            $actions->setFactory($factory);
        }
        
        return $actions;
    }
    
    /**
     * @param type $class
     * @param string|null $method
     * @param ActionParamsInteface|null $params
     * @param FactoryInteface|null $factory
     * @return ActionRegistryInteface
     */
    public function onBeforeAdd($class, ?string $method = null, ?ActionParamsInteface $params = null, ?FactoryInteface $factory = null) : ActionRegistryInteface
    {
        return $this->on(
                factory: $factory ?? $this->getFactory(),
                class: $class
                , method: $method
                , actionOperation: ActionOperation::beforeSave
                , eventOperation: EventOperation::Add
                , params: $params
        );
    }
    
    /**
     * @param type $class
     * @param string|null $method
     * @param ActionParamsInteface|null $params
     * @param FactoryInteface|null $factory
     * @return ActionRegistryInteface
     */
    public function onAfterAdd($class, ?string $method = null, ?ActionParamsInteface $params = null, ?FactoryInteface $factory = null) : ActionRegistryInteface
    {
        return $this->on(
                factory: $factory ?? $this->getFactory(),
                class: $class
                , method: $method
                , actionOperation: ActionOperation::beforeSave
                , eventOperation: EventOperation::Add
                , params: $params
        );
    }
    
    /**
     * @param type $class
     * @param string|null $method
     * @param ActionParamsInteface|null $params
     * @param FactoryInteface|null $factory
     * @return ActionRegistryInteface
     */
    public function onBeforeUpdate($class, ?string $method = null, ?ActionParamsInteface $params = null, ?FactoryInteface $factory = null) : ActionRegistryInteface
    {
        return $this->on(
                factory: $factory ?? $this->getFactory(),
                class: $class
                , method: $method
                , actionOperation: ActionOperation::beforeSave
                , eventOperation: EventOperation::Update
                , params: $params
        );
    }
    
    /**
     * @param type $class
     * @param string|null $method
     * @param ActionParamsInteface|null $params
     * @param FactoryInteface|null $factory
     * @return ActionRegistryInteface
     */
    public function onAfterUpdate($class, ?string $method = null, ?ActionParamsInteface $params = null, ?FactoryInteface $factory = null) : ActionRegistryInteface
    {
        return $this->on(
                factory: $factory ?? $this->getFactory(),
                class: $class
                , method: $method
                , actionOperation: ActionOperation::afterSave
                , eventOperation: EventOperation::Update
                , params: $params
        );
    }
    
    /**
     * @param type $class
     * @param string|null $method
     * @param ActionParamsInteface|null $params
     * @param FactoryInteface|null $factory
     * @return ActionRegistryInteface
     */
    public function onBeforeDelete($class, ?string $method = null, ?ActionParamsInteface $params = null, ?FactoryInteface $factory = null) : ActionRegistryInteface
    {
        return $this->on(
                factory: $factory ?? $this->getFactory(),
                class: $class
                , method: $method
                , actionOperation: ActionOperation::beforeSave
                , eventOperation: EventOperation::Delete
                , params: $params
        );
    }
    
    /**
     * @param type $class
     * @param string|null $method
     * @param ActionParamsInteface|null $params
     * @param FactoryInteface|null $factory
     * @return ActionRegistryInteface
     */
    public function onAfterDelete($class, ?string $method = null, ?ActionParamsInteface $params = null, ?FactoryInteface $factory = null) : ActionRegistryInteface
    {
        return $this->on(
                factory: $factory ?? $this->getFactory(),
                class: $class
                , method: $method
                , actionOperation: ActionOperation::afterSave
                , eventOperation: EventOperation::Delete
                , params: $params
        );
    }
    
    /**
     * @param FactoryInteface $factory
     * @param type $class
     * @param string|null $method
     * @param ActionOperation $actionOperation
     * @param EventOperation $eventOperation
     * @param ActionParamsInteface|null $params
     * @return ActionRegistryInteface
     */
    public function on(FactoryInteface $factory, $class, ?string $method = null, ActionOperation $actionOperation, EventOperation $eventOperation, ?ActionParamsInteface $params = null) : ActionRegistryInteface
    {
        /** @var ActionFactoryInteface */
        $action = $this->actionFactory->getAction();
        
        $action->setClass($class);
        $action->setMethod($method ?? '__invoke');
        $action->setActionOperation($actionOperation);
        $action->setEventOperation($eventOperation);
        $action->setParams($params ?? $this->actionFactory->getActionParams());
        
        /** @var ActionCollectionInteface */
        $this->getFactoryCollection()->push($action);

        $this->last = $action;
        
        return $this;
    }
    
    /**
     * @param int $value
     * @return ActionRegistryInteface
     */
    public function sort(int $value) : ActionRegistryInteface
    {
        $this->last->getParams()->setSort($value);
        return $this;
    }
    
    /**
     * @param string $value
     * @return ActionRegistryInteface
     */
    public function name(string $value) : ActionRegistryInteface
    {
        $this->last->getParams()->setName($value);
        return $this;
    }
    
    /**
     * @return $this
     */
    public function enable()
    {
        $this->last->getParams()->setEnable(true);
        return $this;
    }
    
    /**
     * @return $this
     */
    public function disable()
    {
        $this->last->getParams()->setEnable(false);
        return $this;
    }
    
    /**
     * @param SortOperation $sort
     * @param FactoryInteface|null $factory
     * @return ActionCollectionInteface
     */
    public function getOnBeforeAdd(SortOperation $sort = SortOperation::Asc, ?FactoryInteface $factory = null) : ActionCollectionInteface
    {
        return $this->getOn(
                factory: $factory ?? $this->getFactory()
                , actionOperation: ActionOperation::beforeSave
                , eventOperation: EventOperation::Add
                , sort: $sort
        );
    }
    
    /**
     * @param SortOperation $sort
     * @param FactoryInteface|null $factory
     * @return ActionCollectionInteface
     */
    public function getOnAfterAdd(SortOperation $sort = SortOperation::Asc, ?FactoryInteface $factory = null) : ActionCollectionInteface
    {
        return $this->getOn(
                factory: $factory ?? $this->getFactory()
                , actionOperation: ActionOperation::afterSave
                , eventOperation: EventOperation::Add
                , sort: $sort
        );
    }
    
    /**
     * @param SortOperation $sort
     * @param FactoryInteface|null $factory
     * @return ActionCollectionInteface
     */
    public function getOnBeforeUpdate(SortOperation $sort = SortOperation::Asc, ?FactoryInteface $factory = null) : ActionCollectionInteface
    {
        return $this->getOn(
                factory: $factory ?? $this->getFactory()
                , actionOperation: ActionOperation::beforeSave
                , eventOperation: EventOperation::Update
                , sort: $sort
        );
    }
    
    /**
     * @param SortOperation $sort
     * @param FactoryInteface|null $factory
     * @return ActionCollectionInteface
     */
    public function getOnAfterUpdate(SortOperation $sort = SortOperation::Asc, ?FactoryInteface $factory = null) : ActionCollectionInteface
    {
        return $this->getOn(
                factory: $factory ?? $this->getFactory()
                , actionOperation: ActionOperation::afterSave
                , eventOperation: EventOperation::Update
                , sort: $sort
        );
    }
    
    /**
     * @param SortOperation $sort
     * @param FactoryInteface|null $factory
     * @return ActionCollectionInteface
     */
    public function getOnBeforeDelete(SortOperation $sort = SortOperation::Asc, ?FactoryInteface $factory = null) : ActionCollectionInteface
    {
        return $this->getOn(
                factory: $factory ?? $this->getFactory()
                , actionOperation: ActionOperation::beforeSave
                , eventOperation: EventOperation::Delete
                , sort: $sort
        );
    }
    
    /**
     * @param SortOperation $sort
     * @param FactoryInteface|null $factory
     * @return ActionCollectionInteface
     */
    public function getOnAfterDelete(SortOperation $sort = SortOperation::Asc, ?FactoryInteface $factory = null) : ActionCollectionInteface
    {
        return $this->getOn(
                factory: $factory ?? $this->getFactory()
                , actionOperation: ActionOperation::afterSave
                , eventOperation: EventOperation::Delete
                , sort: $sort
        );
    }
    
    /**
     * @param FactoryInteface $factory
     * @param ActionOperation $actionOperation
     * @param EventOperation $eventOperation
     * @param SortOperation $sort
     * @return ActionCollectionInteface
     */
    public function getOn(FactoryInteface $factory, ActionOperation $actionOperation, EventOperation $eventOperation, SortOperation $sort = SortOperation::Asc) : ActionCollectionInteface
    {   
        /** @var ActionCollectionInteface */
        return $this->getFactoryCollection()
                ->filter(fn(/** @var ActionFactoryInteface */ $action) => $action->getParams()->getEnable())
                ->filter(fn(/** @var ActionFactoryInteface */ $action) => $action->getActionOperation() === $actionOperation)
                ->filter(fn(/** @var ActionFactoryInteface */ $action) => $action->getEventOperation() === $eventOperation)
                ->sort(fn(/** @var ActionFactoryInteface */ $a, /** @var ActionFactoryInteface */$b) 
                            => ($sort === SortOperation::Desc) 
                                ? $b->getParams()->getSort() <=> $a->getParams()->getSort()
                                : $a->getParams()->getSort() <=> $b->getParams()->getSort()
                )
            ;
    }
    
    /**
     * @return ActionCollectionInteface
     */
    public function getFactoryCollection() : ActionCollectionInteface
    {
        if (!(static::$actions[$this->factory->getInstanceCode()] instanceof ActionCollectionInteface))
        {
            static::$actions[$this->factory->getInstanceCode()] = $this->actionFactory->getActionCollection();
        }
        
        /** @var ActionCollectionInteface */
        return static::$actions[$this->factory->getInstanceCode()];
    }
    
    /**
     * @param FactoryInteface $factory
     * @return ActionRegistryInteface
     */
    public function setFactory(FactoryInteface $factory) : ActionRegistryInteface
    {
        $this->factory = $factory;
        return $this;
    }
    
    /**
     * @return FactoryInteface
     */
    public function getFactory() : FactoryInteface
    {
        return $this->factory;
    }
    
    /**
     * @param ActionFactoryInteface $actionFactory
     * @return ActionRegistryInteface
     */
    public function setActionFactory(ActionFactoryInteface $actionFactory) : ActionRegistryInteface
    {
        $this->actionFactory = $actionFactory;
        return $this;
    }
    
    /**
     * @return ActionFactoryInteface
     */
    public function getActionFactory() : ActionFactoryInteface
    {
        return $this->actionFactory;
    }
}

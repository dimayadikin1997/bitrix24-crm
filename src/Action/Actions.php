<?php

declare(strict_types=1);

namespace Yadikin\Bitrix24\Crm\Action;

use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionRegistryInteface;
use Yadikin\Bitrix24\Crm\Factory\Intefaces\FactoryInteface;

/**
 * Description of Actions
 *
 * @author dimay
 */
class Actions implements ActionRegistryInteface
{
    /** @var FactoryInteface|null */
    protected ?FactoryInteface $factory = null;
            
    /**
     * @return ActionRegistryInteface
     */
    public static function getInstance() : ActionRegistryInteface
    {
        return new static();
    }
    
    /**
     * @return ActionRegistryInteface
     */
    public static function make(?FactoryInteface $factory = null) : ActionRegistryInteface
    {
        $actions = static::getInstance();
        
        if ($factory instanceof FactoryInteface)
        {
            $actions->setFactory($factory);
        }
        
        return $actions;
    }
    
    /**
     * @return FactoryInteface
     */
    public function getFactory() : FactoryInteface
    {
        return $this->factory;
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
}

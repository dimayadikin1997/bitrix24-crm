<?php

declare(strict_types=1);

namespace Yadikin\Bitrix24\Crm\Action\Intefaces;

use Yadikin\Bitrix24\Crm\Factory\Intefaces\FactoryInteface;

/**
 *
 * @author dimay
 */
interface ActionRegistryInteface 
{
    /**
     * @return FactoryInteface
     */
    public function getFactory() : FactoryInteface;
    
    /**
     * @param FactoryInteface $factory
     * @return ActionRegistryInteface
     */
    public function setFactory(FactoryInteface $factory) : ActionRegistryInteface;
}

<?php

namespace Yadikin\Bitrix24\Crm\Action\Intefaces;

use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionInteface;
use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionParamsInteface;
use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionCollectionInteface;

/**
 * @author dimay
 */
interface ActionFactoryInteface 
{
    /**
     * @return ActionInteface
     */
    public function getAction() : ActionInteface;
    
    /**
     * @return ActionParamsInteface
     */
    public function getActionParams() : ActionParamsInteface;
    
    /**
     * @return ActionCollectionInteface
     */
    public function getActionCollection() : ActionCollectionInteface;
}

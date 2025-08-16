<?php

namespace Yadikin\Bitrix24\Crm\Action;

use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionFactoryInteface;

use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionCollectionInteface;
use Yadikin\Bitrix24\Crm\Action\ActionCollection;
use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionParamsInteface;
use Yadikin\Bitrix24\Crm\Action\ActionParams;
use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionInteface;
use Yadikin\Bitrix24\Crm\Action\Action;

/**
 * Description of ActionFactory
 *
 * @author dimay
 */
class ActionFactory implements ActionFactoryInteface
{
    /**
     * @return ActionInteface
     */
    public function getAction() : ActionInteface
    {
        return new Action();
    }
    
    /**
     * @return ActionParamsInteface
     */
    public function getActionParams() : ActionParamsInteface
    {
        return new ActionParams();
    }
    
    /**
     * @return ActionCollectionInteface
     */
    public function getActionCollection() : ActionCollectionInteface
    {
        return new ActionCollection();
    }
}

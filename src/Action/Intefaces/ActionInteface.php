<?php

namespace Yadikin\Bitrix24\Crm\Action\Intefaces;
     
use Bitrix\Crm\Item;
use Bitrix\Main\Result;

use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionParamsInteface;
use Yadikin\Bitrix24\Crm\Action\Support\ActionOperation;
use Yadikin\Bitrix24\Crm\Action\Support\EventOperation;

/**
 *
 * @author dimay
 */
interface ActionInteface 
{
    /**
     * @param type $class
     */
    public function setClass($class);
    
    /**
     * 
     */
    public function getClass();
    
    /**
     * @param string $method
     */
    public function setMethod(string $method);
    
    /**
     * @return string
     */
    public function getMethod() : string;
    
    /**
     * @param ActionOperation $actionOperation
     */
    public function setActionOperation(ActionOperation $actionOperation);
    
    /**
     * @return ActionOperation
     */
    public function getActionOperation() : ActionOperation;
    
    /**
     * @param EventOperation $eventOperation
     */
    public function setEventOperation(EventOperation $eventOperation);
    
    /**
     * @return EventOperation
     */
    public function getEventOperation() : EventOperation;
    
    /**
     * @param ActionParamsInteface $params
     */
    public function setParams(ActionParamsInteface $params);
    
    /**
     * @return ActionParamsInteface
     */
    public function getParams() : ActionParamsInteface;
     
    /**
     * @param Item $item
     * @return Result
     */
    public function process(Item $item): Result;
}

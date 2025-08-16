<?php

namespace Yadikin\Bitrix24\Crm\Action;

use Bitrix\Crm\Item;
use Bitrix\Main\Result;

use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionInteface;
use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionParamsInteface;
use Yadikin\Bitrix24\Crm\Action\Support\ActionOperation;
use Yadikin\Bitrix24\Crm\Action\Support\EventOperation;

/**
 * Description of Action
 *
 * @author dimay
 */
class Action extends \Bitrix\Crm\Service\Operation\Action implements ActionInteface 
{
    /** @var object */
    protected $class;
    
    /** @var string|null */
    protected ?string $method = null;
    
    /** @var ActionOperation|null */
    protected ?ActionOperation $actionOperation = null;
    
    /** @var EventOperation|null */
    protected ?EventOperation $eventOperation = null;
    
    /** @var ActionParamsInteface|null */
    protected ?ActionParamsInteface $params = null;
    
    /**
     * @param type $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }
    
    /**
     * @return type
     */
    public function getClass()
    {
        return $this->class;
    }
    
    /**
     * @param string $method
     */
    public function setMethod(string $method)
    {
        $this->method = $method;
    }
    
    /**
     * @return string
     */
    public function getMethod() : string
    {
        return $this->method;
    }
    
    /**
     * @param ActionOperation $actionOperation
     */
    public function setActionOperation(ActionOperation $actionOperation)
    {
        $this->actionOperation = $actionOperation;
    }
    
    /**
     * @return ActionOperation
     */
    public function getActionOperation() : ActionOperation
    {
        return $this->actionOperation;
    }
    
    /**
     * @param EventOperation $eventOperation
     */
    public function setEventOperation(EventOperation $eventOperation)
    {
        $this->eventOperation = $eventOperation;
    }
    
    /**
     * @return EventOperation
     */
    public function getEventOperation() : EventOperation
    {
        return $this->eventOperation;
    }
    
    /**
     * @param ActionParamsInteface $params
     */
    public function setParams(ActionParamsInteface $params)
    {
        $this->params = $params;
    }
    
    /**
     * @return ActionParamsInteface
     */
    public function getParams() : ActionParamsInteface
    {
        return $this->params;
    }
    
    public function process(Item $item): Result 
    {
        $this->result = new Result();
         
        $result = call_user_func_array(
            [$this->class, $this->method],
            [$item]
        );
          
        if ($result instanceof Result)
        {
            $this->setRerrors($result);
        }
        
        return $this->result;
    }
    
    protected function setRerrors (Result $result) 
    {
        foreach($result->getErrors() as $error)
        {
           $this->result->addError($error);
        }
    }
}

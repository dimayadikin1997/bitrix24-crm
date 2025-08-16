<?php

namespace Yadikin\Bitrix24\Crm\Action;

use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionParamsInteface;

/**
 * Description of ActionParams
 *
 * @author dimay
 */
class ActionParams implements ActionParamsInteface
{
    /** @var int */
    protected int $sort = 100;
    
    /** @var string */
    protected string $name = '';
    
    /** @var bool */
    protected bool $enable = true;
    
    /**
     * @param int $value
     * @return ActionParamsInteface
     */
    public function setSort(int $value) : ActionParamsInteface
    {
        $this->sort = $value;
        return $this;
    }
    
    /**
     * @return int
     */
    public function getSort() : int
    {
        return $this->sort;
    }
    
    /**
     * @param string $value
     * @return ActionParamsInteface
     */
    public function setName(string $value) : ActionParamsInteface
    {
        $this->name = $value;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
    
    /**
     * @param bool $value
     * @return ActionParamsInteface
     */
    public function setEnable(bool $value) : ActionParamsInteface
    {
        $this->enable = $value;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getEnable() : bool
    {
        return $this->enable;
    }
}

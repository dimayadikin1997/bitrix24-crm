<?php

namespace Yadikin\Bitrix24\Crm\Action\Intefaces;

/**
 *
 * @author dimay
 */
interface ActionParamsInteface 
{
    /**
     * @param int $value
     * @return ActionParamsInteface
     */
    public function setSort(int $value) : ActionParamsInteface;
    
    /**
     * @return int
     */
    public function getSort() : int;
    
    /**
     * @param string $value
     * @return ActionParamsInteface
     */
    public function setName(string $value) : ActionParamsInteface;
    
    /**
     * @return string
     */
    public function getName() : string;
    
    /**
     * @param bool $value
     * @return ActionParamsInteface
     */
    public function setEnable(bool $value) : ActionParamsInteface;
    
    /**
     * @return string
     */
    public function getEnable() : bool;
}

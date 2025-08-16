<?php

declare(strict_types=1);

namespace Yadikin\Bitrix24\Crm\Factory\Intefaces;

/**
 * @author dimay
 */
interface FactoryInteface 
{
    /**
     * @return string
     */
    public function getInstanceCode() : string;
}

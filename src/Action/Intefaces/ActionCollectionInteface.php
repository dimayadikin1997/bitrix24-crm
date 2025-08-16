<?php

namespace Yadikin\Bitrix24\Crm\Action\Intefaces;

use Yadikin\Bitrix24\Crm\Internal\Intefaces\CollectionInterface;
use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionInteface;

/**
 *
 * @author dimay
 */
interface ActionCollectionInteface extends CollectionInterface
{
    public function push(ActionInteface $item) : ActionCollectionInteface;
    
    /**
     * @return ActionInteface
     */
    public function first() : ActionInteface;
    
    /**
     * @param callable $fn
     * @return ActionCollectionInteface
     */
    public function filter(callable $fn) : ActionCollectionInteface;
    
    /**
     * @param callable $fn
     * @return ActionCollectionInteface
     */
    public function sort(callable $fn) : ActionCollectionInteface;
}

<?php

namespace Yadikin\Bitrix24\Crm\Action;

use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionCollectionInteface;
use Yadikin\Bitrix24\Crm\Internal\Collection;
use Yadikin\Bitrix24\Crm\Action\Intefaces\ActionInteface;

/**
 * Description of ActionCollection
 *
 * @author dimay
 */
class ActionCollection extends Collection implements ActionCollectionInteface
{
    public function push(ActionInteface $item): ActionCollectionInteface 
    {
        $this->items[] = $item;
        return $this;
    }
    
    /**
     * @return ActionInteface
     */
    public function first() : ActionInteface
    {
        return parent::first();
    }
    
    /**
     * @param callable $fn
     * @return CollectionInterface
     */
    public function filter(callable $fn) : ActionCollectionInteface
    {
        return parent::filter($fn);
    }
}

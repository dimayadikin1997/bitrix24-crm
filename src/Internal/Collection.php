<?php

namespace Yadikin\Bitrix24\Crm\Internal;

use Yadikin\Bitrix24\Crm\Internal\Intefaces\CollectionInterface;

/**
 * Description of Collection
 *
 * @author d.yadikin
 */
class Collection implements \Countable, \Iterator, \ArrayAccess, CollectionInterface
{
    /**
     * @var type
     */
    protected array $items = [];
    
    private $position = 0;

    /**
     * This constructor is there in order to be able to create a collection with
     * its values already added
     */
    public function __construct(array $items = [])
    {
        foreach ($items as $key=>$item) 
        {
            $this->offsetSet('', $item);
        }
    }

    /**
     * Implementation of method declared in \Countable.
     * Provides support for count()
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * Implementation of method declared in \Iterator
     * Resets the internal cursor to the beginning of the array
     */
    public function rewind() : CollectionInterface
    {
        $this->position = 0;
        return $this;
    }

    /**
     * Implementation of method declared in \Iterator
     * Used to get the current key (as for instance in a foreach()-structure
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Implementation of method declared in \Iterator
     * Used to get the value at the current cursor position
     */
    public function current()
    {
        return $this->items[$this->position];
    }

    /**
     * Implementation of method declared in \Iterator
     * Used to move the cursor to the next position
     */
    public function next() : CollectionInterface
    {
        $this->position++;
        return $this;
    }

    /**
     * Implementation of method declared in \Iterator
     * Checks if the current cursor position is valid
     */
    public function valid()
    {
        return isset($this->items[$this->position]);
    }

    /**
     * Implementation of method declared in \ArrayAccess
     * Used to be able to use functions like isset()
     */
    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    /**
     * Implementation of method declared in \ArrayAccess
     * Used for direct access array-like ($collection[$offset]);
     */
    public function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    /**
     * Implementation of method declared in \ArrayAccess
     * Used for direct setting of values
     */
    public function offsetSet($offset, $item)
    {
        if (empty($offset))
        {
            $this->items[] = $item;
        }
        else
        {
            $this->items[$offset] = $item;
        }
    }

    /**
     * Implementation of method declared in \ArrayAccess
     * Used for unset()
     */
    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }
    
    public function add($item) : CollectionInterface
    {
        $this->items[] = $item;
        return $this;
    }
    
    public function first()
    {
        return current($this->items); 
    }
    
    public function filter(callable $fn) : CollectionInterface
    {
        $items = array_filter($this->items, $fn); 
        return new static($items); 
    }
    
    /**
     * @param callable $fn
     * @return CollectionInterface
     */
    public function sort(callable $fn) : CollectionInterface
    {
        $items = $this->items;
        usort($items, $fn); 
        return new static($items); 
    }
    
    /**
     * @return array
     */
    public function toJson() : array
    {
        return $this->items;
    }
}

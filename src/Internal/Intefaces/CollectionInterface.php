<?php

namespace Yadikin\Bitrix24\Crm\Internal\Intefaces;

/**
 * Description of Collection
 *
 */
interface CollectionInterface
{
    /**
     * Implementation of method declared in \Countable.
     * Provides support for count()
     */
    public function count();

    /**
     * Implementation of method declared in \Iterator
     * Resets the internal cursor to the beginning of the array
     */
    public function rewind();

    /**
     * Implementation of method declared in \Iterator
     * Used to get the current key (as for instance in a foreach()-structure
     */
    public function key();

    /**
     * Implementation of method declared in \Iterator
     * Used to get the value at the current cursor position
     */
    public function current();

    /**
     * Implementation of method declared in \Iterator
     * Used to move the cursor to the next position
     */
    public function next();

    /**
     * Implementation of method declared in \Iterator
     * Checks if the current cursor position is valid
     */
    public function valid();

    /**
     * Implementation of method declared in \ArrayAccess
     * Used to be able to use functions like isset()
     */
    public function offsetExists($offset);

    /**
     * Implementation of method declared in \ArrayAccess
     * Used for direct access array-like ($collection[$offset]);
     */
    public function offsetGet($offset);

    /**
     * Implementation of method declared in \ArrayAccess
     * Used for direct setting of values
     */
    public function offsetSet($offset, $item);

    /**
     * Implementation of method declared in \ArrayAccess
     * Used for unset()
     */
    public function offsetUnset($offset);
    
    /**
     * 
     */
    public function first();
    
    /**
     * @param callable $fn
     * @return CollectionInterface
     */
    public function filter(callable $fn) : CollectionInterface;
    
    /**
     * @param callable $fn
     * @return CollectionInterface
     */
    public function sort(callable $fn) : CollectionInterface;
    
    /**
     * @return array
     */
    public function toJson() : array;
}

<?php

declare(strict_types=1);

namespace Yadikin\Bitrix24\Crm\Action\Support;

enum EventOperation 
{
    /* Add element */
    case Add;
    
    /* Update element */
    case Update;
    
    /* Delete element */
    case Delete;
}

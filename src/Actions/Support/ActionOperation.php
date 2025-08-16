<?php

declare(strict_types=1);

namespace Yadikin\Bitrix24\Crm\Action\Support;

enum ActionOperation
{
    /* Before save element */
    case beforeSave;
    
    /* After save element */
    case afterSave;
}
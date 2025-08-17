# Bitrix24/Crm 

## Установка

```bash
composer require dimayadikin1997/bitrix24-crm
```

## Использование

### Шаг 1. Создать фабрику
```php
<?php
/// файл local/modules/your.module/lib/Crm/Service/Factory/Dynamic/OrderFactory.php

namespace Your\Module\Crm\Service\Factory\Dynamic;

use Bitrix\Crm\Service\Factory\Dynamic;
use Bitrix\Crm\Service\Container;
use Bitrix\Crm\Service\Context;
use Bitrix\Crm\Service\Operation;
use Bitrix\Crm\Model\Dynamic\TypeTable;
use Bitrix\Crm\Item;

use Yadikin\Bitrix24\Crm\Factory\Intefaces\FactoryInteface;

class OrderFactory extends Dynamic implements FactoryInteface
{
    /** @var int */
    protected int $entityTypeId = 1036; // Идентификатор типа смарт-процесса

    /// Требуется для класса Dynamic
    public function __construct() 
    {
        $type = TypeTable::getByEntityTypeId($this->entityTypeId)->fetchObject();

        if (!is_null($type)) {
            parent::__construct($type);
        }
    }

    /**
     * return string
     */
    public function getInstanceCode() : string
    {
        /// Вернет "crm.service.factory.dynamic.1036"
        $identifier = Container::getIdentifierByClassName(Dynamic::class, [$this->entityTypeId]);
        return $identifier;
    }
    
    /// Переопределить родительский метод
    public function getAddOperation(Item $item, Context $context = null): Operation\Add
    {
        $operation = parent::getAddOperation($item, $context);

        // добавляем Action`s

        return $operation;
    }

    /// Переопределить родительский метод
    public function getUpdateOperation(Item $item, Context $context = null): Operation\Update
    {
        $operation = parent::getUpdateOperation($item, $context);

        // добавляем Action`s

        return $operation;
    }
}
```

### Шаг 2. Добавляем фабрику в ServiceLocator
Добавить фабрику в ServiceLocator можно, например в `init.php`
```php
<?php
/// файл init.php

/// ....

$orderFactory = new Your\Module\Crm\Service\Factory\Dynamic\OrderFactory();

$serviceLocator = \Bitrix\Main\DI\ServiceLocator::getInstance();

$serviceLocator->addInstanceLazy($orderFactory->getInstanceCode(), [
    'className' => $orderFactory,
]);

/// ....

```

### Шаг 3. Создаем Action
```php
<?php
/// файл local/modules/your.module/lib/Crm/Service/Action/Order/OrderBaseAction.php

namespace Your\Module\Crm\Service\Action\Order;

use Bitrix\Main\Result;
use Bitrix\Main\Error;
use Bitrix\Crm\Item;

class OrderBaseAction 
{
    public function run(Item $item) : Result
    {
        $result = new Result();
        
        /// Ваша бизнес-логика
        $result->addError(new Error("Пример ошибки!"));
        
        return $result;
    }
}
```
### Шаг 4. Добавляем Ваш Action в ActionRegistry
Добавить Action можно, например в `init.php`
```php
<?php
/// файл init.php

/// ....

$actionsOrder = \Yadikin\Bitrix24\Crm\Action\Actions::make(/** @var OrderFactory */$orderFactory);

$actionsOrder->onBeforeAdd(new \Your\Module\Crm\Service\Action\Order\OrderBaseAction(), 'run'); // Вызывает метод run перед добавлением элемента в СП
$actionsOrder->onBeforeUpdate(new \Your\Module\Crm\Service\Action\Order\OrderBaseAction(), 'run'); // Вызывает метод run перед редактированием элемента в СП

/// ....
```
### Шаг 5. Получаем все Action`s в фабрике
```php
<?php
/// файл local/modules/your.module/lib/Crm/Service/Factory/Dynamic/OrderFactory.php

namespace Your\Module\Crm\Service\Factory\Dynamic;

use Bitrix\Crm\Service\Factory\Dynamic;
use Bitrix\Crm\Service\Container;
use Bitrix\Crm\Service\Context;
use Bitrix\Crm\Service\Operation;
use Bitrix\Crm\Model\Dynamic\TypeTable;
use Bitrix\Crm\Item;
use Yadikin\Bitrix24\Crm\Factory\Intefaces\FactoryInteface;

class OrderFactory extends Dynamic implements FactoryInteface
{
    /** @var int */
    protected int $entityTypeId = 1036; // Идентификатор типа смарт-процесса

    /// Требуется для класса Dynamic
    public function __construct() 
    {
        $type = TypeTable::getByEntityTypeId($this->entityTypeId)->fetchObject();

        if (!is_null($type)) {
            parent::__construct($type);
        }
    }

    /**
     * return string
     */
    public function getInstanceCode() : string
    {
        /// Вернет "crm.service.factory.dynamic.1036"
        $identifier = Container::getIdentifierByClassName(Dynamic::class, [$this->entityTypeId]);
        return $identifier;
    }
    
    /// Переопределить родительский метод
    public function getAddOperation(Item $item, Context $context = null): Operation\Add
    {
        $operation = parent::getAddOperation($item, $context);

        // добавляем Action`s
        $actionsOrder = \Yadikin\Bitrix24\Crm\Action\Actions::make(/** @var OrderFactory */$this);

        foreach($actionsOrder->getOnBeforeAdd() as $action)
        {
            $operation->addAction(
                Operation::ACTION_BEFORE_SAVE,
                $action
            );
        }

        foreach($actionsOrder->getOnAfterAdd() as $action)
        {
            $operation->addAction(
                Operation::ACTION_AFTER_SAVE,
                $action
            );
        }

        return $operation;
    }

    /// Переопределить родительский метод
    public function getUpdateOperation(Item $item, Context $context = null): Operation\Update
    {
        $operation = parent::getUpdateOperation($item, $context);

        // добавляем Action`s
        $actionsOrder = \Yadikin\Bitrix24\Crm\Action\Actions::make(/** @var OrderFactory */$this);

        foreach($actionsOrder->getOnBeforeUpdate() as $action)
        {
            $operation->addAction(
                Operation::ACTION_BEFORE_SAVE,
                $action
            );
        }

        foreach($actionsOrder->getOnAfterUpdate() as $action)
        {
            $operation->addAction(
                Operation::ACTION_AFTER_SAVE,
                $action
            );
        }

        return $operation;
    }
}
```
### Результат
![Результат](https://github.com/dimayadikin1997/bitrix24-crm/blob/main/raw/main/images/Screenshot_1.png)

### Добавить ещё 
Тпереь для добавления новго Actions
```php
<?php
/// файл init.php

/// Так же продолжаем добавлять
$actionsOrder->onBeforeDelete(new Order\OtherAction(), 'run');

/// ....


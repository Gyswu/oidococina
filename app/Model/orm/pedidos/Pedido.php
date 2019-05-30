<?php

namespace App\Model\Orm;

use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasMany;

/**
 * Pedido
 *
 * @property int                 $id     {primary}
 * @property Mesa                $mesa   {m:1 Mesa::$pedido}
 * @property ManyHasMany|Plato[] $plato  {m:m Plato::$pedido, isMain=true}
 * @property int                 $state
 */
class Pedido extends Entity {

}
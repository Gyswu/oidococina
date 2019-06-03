<?php

namespace App\Model\Orm;

use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasMany;

/**
 * Pedido
 *
 * @property int                 $id      {primary}
 * @property Mesa                $mesa    {m:1 Mesa::$pedidos}
 * @property ManyHasMany|Plato[] $platos  {m:m Plato::$pedidos, isMain=true}
 * @property int                 $estado
 */
class Pedido extends Entity {

}
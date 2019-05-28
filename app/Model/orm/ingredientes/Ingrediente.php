<?php

namespace App\Model\Orm;

use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasMany;

/**
 * Ingrediente
 *
 * @property int                 $id             {primary}
 * @property int                 $cantidad
 * @property ManyHasMany|Plato[] $platos         {m:m Plato::$ingredientes}
 * @property Producto            $producto       {1:1 Producto, isMain=true, oneSided=true}
 */
class Ingrediente extends Entity {

}
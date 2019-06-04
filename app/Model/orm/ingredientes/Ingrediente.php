<?php

namespace App\Model\Orm;

use Nextras\Dbal\Utils\DateTimeImmutable;
use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasMany;

/**
 * Ingrediente
 *
 * @property int                 $id             {primary}
 * @property int                 $cantidad
 * @property ManyHasMany|Plato[] $platos         {m:m Plato::$ingredientes}
 * @property Producto            $producto       {1:1 Producto, isMain=true, oneSided=true}
 * @property DateTimeImmutable   $createdAt      {default now}
 * @property DateTimeImmutable   $updatedAt      {default now}
 */
class Ingrediente extends Entity {

}
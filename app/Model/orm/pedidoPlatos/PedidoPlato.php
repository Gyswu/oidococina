<?php

namespace App\Model\Orm;

use Nextras\Dbal\Utils\DateTimeImmutable;
use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasMany;

/**
 * Plato
 *
 * @property int               $id              {primary}
 * @property Pedido            $pedido          {m:1 Pedido::$pedidoPlatos}
 * @property Plato             $plato           {m:1 Plato::$pedidoPlatos}
 * @property DateTimeImmutable $createdAt       {default now}
 * @property DateTimeImmutable $updatedAt       {default now}
 */
class PedidoPlato extends Entity {
    
    //Aquí van los platos de cada pedido, relación 1:m o 1 pedido muchos platos
}

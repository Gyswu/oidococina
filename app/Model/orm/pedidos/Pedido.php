<?php

namespace App\Model\Orm;

use Nextras\Dbal\Utils\DateTimeImmutable;
use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasMany;

/**
 * Pedido
 *
 * @property int                 $id        {primary}
 * @property Mesa                $mesa      {m:1 Mesa::$pedidos}
 * @property ManyHasMany|Plato[] $platos    {m:m Plato::$pedidos, isMain=true}
 * @property int|null            $estado    {default 0}
 * @property DateTimeImmutable   $createdAt {default now}
 * @property DateTimeImmutable   $updatedAt {default now}
 */
class Pedido extends Entity {
    
    public const ESTADOS = [
        'reservar'  => 0,
        'yaPedido'  => 1,
        'preparado' => 2,
        'servido'   => 3,
        'pagado'    => 4,
    ];
    
}
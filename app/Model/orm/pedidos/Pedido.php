<?php

namespace App\Model\Orm;

use Nextras\Dbal\Utils\DateTimeImmutable;
use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\OneHasMany;

/**
 * Pedido
 *<b>
 * Comentario
 * </b>
 * @property int                      $id                      {primary}
 * @property Mesa                     $mesa                    {m:1 Mesa::$pedidos}
 * @property OneHasMany|PedidoPlato[] $pedidoPlatos            {1:m PedidoPlato::$pedido}
 * @property int|null                 $estado                  {default 0}
 * @property DateTimeImmutable        $createdAt               {default now}
 * @property DateTimeImmutable        $updatedAt               {default now}
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
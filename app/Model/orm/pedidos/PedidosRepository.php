<?php

namespace App\Model\Orm;

use Nextras\Orm\Repository\Repository;

/**
 * @method Pedido|NULL getById( $id )
 */
class PedidosRepository extends Repository {
    
    static function getEntityClassNames(): array {
        return [ Pedido::class ];
    }
}
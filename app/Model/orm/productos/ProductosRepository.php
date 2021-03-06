<?php

namespace App\Model\Orm;

use Nextras\Orm\Repository\Repository;

/**
 * @method Producto|NULL getById( $id )
 */
class ProductosRepository extends Repository {
    
    static function getEntityClassNames(): array {
        return [ Producto::class ];
    }
}
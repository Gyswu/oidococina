<?php

namespace App\Model\Orm;

use Nextras\Orm\Collection\ICollection;
use Nextras\Orm\Repository\Repository;

/**
 * @method Plato|NULL getById($id)
 */
class ProductosRepository extends Repository {
    
    static function getEntityClassNames(): array {
        return [Producto::class];
    }
}
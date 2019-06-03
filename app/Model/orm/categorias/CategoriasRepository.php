<?php

namespace App\Model\Orm;

use Nextras\Orm\Repository\Repository;

/**
 * @method Categoria|NULL getById( $id )
 */
class CategoriasRepository extends Repository {
    
    static function getEntityClassNames(): array {
        return [ Categoria::class ];
    }
}
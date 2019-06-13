<?php

namespace App\Model\Orm;

use Nextras\Orm\Repository\Repository;

/**
 * @method Usuario|NULL getById( $id )
 */
class UsuariosRepository extends Repository {
    
    static function getEntityClassNames(): array {
        return [ Usuario::class ];
    }
}
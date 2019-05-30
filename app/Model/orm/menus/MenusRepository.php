<?php

namespace App\Model\Orm;

use Nextras\Orm\Repository\Repository;

/**
 * @method Menu|NULL getById( $id )
 */
class MenusRepository extends Repository {
    
    static function getEntityClassNames(): array {
        return [ Menu::class ];
    }
}
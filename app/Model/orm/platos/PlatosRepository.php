<?php

namespace App\Model\Orm;

use Nextras\Orm\Collection\ICollection;
use Nextras\Orm\Repository\Repository;

/**
 * @method Plato|NULL getById($id)
 */
class PlatosRepository extends Repository {

    static function getEntityClassNames(): array {
        return [Plato::class];
    }
}
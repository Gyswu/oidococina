<?php
namespace App\Model\Orm;

use Nextras\Orm\Collection\ICollection;
use Nextras\Orm\Repository\Repository;

/**
 * @method Mesa|NULL getById($id)
 */
class MesasRepository extends Repository {

    static function getEntityClassNames(): array {
        return [Mesa::class];
    }
}
<?php

namespace App\Model\Orm;

use Nextras\Orm\Collection\ICollection;
use Nextras\Orm\Repository\Repository;

/**
 * @method PedidoPlato|NULL getById($id)
 */
class PedidoPlatosRepository extends Repository {

    static function getEntityClassNames(): array {
        return [PedidoPlato::class];
    }
}
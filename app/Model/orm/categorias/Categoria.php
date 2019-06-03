<?php

namespace App\Model\Orm;

use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\OneHasMany;

/**
 * Categoria
 *
 * @property    int                $id     {primary}
 * @property    string             $nombre
 * @property    OneHasMany|Plato[] $platos {1:m Plato::$categoria}
 */
class Categoria extends Entity {

}
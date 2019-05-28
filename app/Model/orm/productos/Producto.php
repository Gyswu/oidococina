<?php

namespace App\Model\Orm;

use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasMany;

/**
 * Producto
 *
 * @property int         $id                {primary}
 * @property string      $nombre
 * @property string      $categoria
 * @property string      $cantidad
 * @property string      $unidad
 */
class Producto extends Entity {

}
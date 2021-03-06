<?php

namespace App\Model\Orm;

use Nextras\Dbal\Utils\DateTimeImmutable;
use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasMany;

/**
 * Producto
 *
 * @property int               $id                {primary}
 * @property string            $nombre
 * @property string            $categoria
 * @property string            $stock             {default 0}
 * @property string            $unidad            {default "num"}
 * @property DateTimeImmutable $createdAt         {default now}
 * @property DateTimeImmutable $updatedAt         {default now}
 */
class Producto extends Entity {

}
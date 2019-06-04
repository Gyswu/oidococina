<?php

namespace App\Model\Orm;

use Nextras\Dbal\Utils\DateTimeImmutable;
use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\OneHasMany;

/**
 * Categoria
 *
 * @property    int                $id        {primary}
 * @property    string             $nombre
 * @property    OneHasMany|Plato[] $platos    {1:m Plato::$categoria}
 * @property    DateTimeImmutable  $createdAt {default now}
 * @property    DateTimeImmutable  $updatedAt {default now}
 */
class Categoria extends Entity {

}
<?php

namespace App\Model\Orm;

use Nextras\Dbal\Utils\DateTimeImmutable;
use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasMany;

/**
 * Menu
 *
 * @property int                 $id             {primary}
 * @property string              $nombre
 * @property float               $precio
 * @property ManyHasMany|Plato[] $platos         {m:m Plato::$menus , isMain=true}
 * @property DateTimeImmutable   $createdAt      {default now}
 * @property DateTimeImmutable   $updatedAt      {default now}
 */
class Menu extends Entity {

//    public function getterComments()
//    {
//        return $this->allComments->get()->findBy(['deletedAt' => NULL]);
//    }
}
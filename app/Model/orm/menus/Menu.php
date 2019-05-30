<?php

namespace App\Model\Orm;

use Nextras\Orm\Entity\Entity;

/**
 * Menu
 *
 * @property int                 $id             {primary}
 * @property string              $nombre
 * @property float               $precio
 * @property ManyHasMany|Plato[] $platos         {m:m Plato::$menus , isMain=true}
 */
class Menu extends Entity {

//    public function getterComments()
//    {
//        return $this->allComments->get()->findBy(['deletedAt' => NULL]);
//    }
}
<?php

namespace App\Model\Orm;

use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasMany;

/**
 * Plato
 *
 * @property int                       $id             {primary}
 * @property string                    $nombre
 * @property float                     $precio
 * @property ManyHasMany|Ingrediente[] $ingredientes   {m:m Ingrediente::$platos , isMain=true}
 * @property ManyHasMany|Menu[]        $menus          {m:m Menu::$platos}
 */
class Plato extends Entity {

//    public function getterComments()
//    {
//        return $this->allComments->get()->findBy(['deletedAt' => NULL]);
//    }
}

// get devuelve uno
// Find devuelve varias
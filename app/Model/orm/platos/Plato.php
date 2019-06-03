<?php

namespace App\Model\Orm;

use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasMany;

/**
 * Plato
 *
 * @property int                       $id              {primary}
 * @property string                    $nombre
 * @property float                     $precio
 * @property ManyHasMany|Ingrediente[] $ingredientes    {m:m Ingrediente::$platos , isMain=true}
 * @property ManyHasMany|Menu[]        $menus           {m:m Menu::$platos}
 * @property ManyHasMany|Pedido[]      $pedidos         {m:m Pedido::$platos}
 * @property Categoria                 $categoria       {m:1 Categoria::$platos}
 */
class Plato extends Entity {

//    public function getterComments()
//    {
//        return $this->allComments->get()->findBy(['deletedAt' => NULL]);
//    }
}

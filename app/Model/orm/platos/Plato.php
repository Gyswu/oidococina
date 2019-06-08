<?php

namespace App\Model\Orm;

use Nextras\Dbal\Utils\DateTimeImmutable;
use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasMany;
use Nextras\Orm\Relationships\OneHasMany;

/**
 * Plato
 *
 * @property int                       $id                      {primary}
 * @property string                    $nombre
 * @property float                     $precio
 * @property ManyHasMany|Ingrediente[] $ingredientes            {m:m Ingrediente::$platos , isMain=true}
 * @property ManyHasMany|Menu[]        $menus                   {m:m Menu::$platos}
 * @property Categoria                 $categoria               {m:1 Categoria::$platos}
 * @property OneHasMany|PedidoPlato[]  $pedidoPlatos            {1:m PedidoPlato::$plato}
 * @property DateTimeImmutable         $createdAt               {default now}
 * @property DateTimeImmutable         $updatedAt               {default now}
 */
class Plato extends Entity {

//    public function getterComments()
//    {
//        return $this->allComments->get()->findBy(['deletedAt' => NULL]);
//    }
}

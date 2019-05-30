<?php

namespace App\Model\Orm;

use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\OneHasMany;

/**
 * Mesa
 *
 * @property int                 $id             {primary}
 * @property string              $nombre
 * @property boolean             $estado
 * @property OneHasMany|Pedido[] $pedido         {1:m Pedido::$mesa}
 */
class Mesa extends Entity {

//    public function getterComments()
//    {
//        return $this->allComments->get()->findBy(['deletedAt' => NULL]);
//    }
}
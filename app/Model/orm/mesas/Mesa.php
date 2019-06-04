<?php

namespace App\Model\Orm;

use Nextras\Dbal\Utils\DateTimeImmutable;
use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\OneHasMany;

/**
 * Mesa
 *
 * @property int                 $id              {primary}
 * @property string              $nombre
 * @property boolean             $estado
 * @property OneHasMany|Pedido[] $pedidos         {1:m Pedido::$mesa}
 * @property DateTimeImmutable   $createdAt       {default now}
 * @property DateTimeImmutable   $updatedAt       {default now}
 */
class Mesa extends Entity {

//    public function getterComments()
//    {
//        return $this->allComments->get()->findBy(['deletedAt' => NULL]);
//    }
}
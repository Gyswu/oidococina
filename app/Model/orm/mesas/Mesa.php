<?php

namespace App\Model\Orm;

use Nextras\Dbal\Utils\DateTimeImmutable;
use Nextras\Orm\Collection\ICollection;
use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\OneHasMany;

/**
 * Mesa
 *
 * @property int                 $id                {primary}
 * @property string              $nombre
 * @property int                 $estado            {default 0}
 * @property OneHasMany|Pedido[] $pedidos           {1:m Pedido::$mesa}
 * @property DateTimeImmutable   $createdAt         {default now}
 * @property DateTimeImmutable   $updatedAt         {default now}
 */
class Mesa extends Entity {
    
    /**
     * Devuelve el último pedido de una mesa si existe alguno en ella
     *
     * @return Pedido|null
     */
    public function getLastPedido() {
        $result = null;
        foreach( $this->pedidos->get()->findBy([ 'mesa' => $this->id ])->orderBy('id', ICollection::DESC)->limitBy(1) as $pedido ) {
            $result = $pedido;
        }
        
        return $result;
    }

//    public function getterComments()
//    {
//        return $this->allComments->get()->findBy(['deletedAt' => NULL]);
//    }
}
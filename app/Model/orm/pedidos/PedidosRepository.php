<?php

namespace App\Model\Orm;

use Nextras\Orm\Collection\ICollection;
use Nextras\Orm\Repository\Repository;

/**
 * @method Pedido|NULL getById( $id )
 */
class PedidosRepository extends Repository {
    
    /**
     * @param $mesaID
     *
     * @return Pedido
     */
    public function getLastInTable( $mesaID ) {
        $result = null;
        foreach( $this->findBy([ 'this->mesa->id' => $mesaID ])->orderBy('id', ICollection::DESC)->limitBy(1) as $pedido ) {
            $result = $pedido;
        }
        
        return $result;
    }
    
    public function findPendientesCocina(){
        return $this->findBy(['estado' => Pedido::ESTADOS['yaPedido']])->orderBy('createdAt',ICollection::ASC);
    }
    
    static function getEntityClassNames(): array {
        return [ Pedido::class ];
    }
}
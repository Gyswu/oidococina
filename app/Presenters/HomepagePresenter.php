<?php
declare( strict_types = 1 );

namespace App\Presenters;

final class HomepagePresenter extends BasePresenter {
    
    public function renderDefault() {
        
        
        //para ver los pedidos de una mesa ya lo he arreglado, pero eso muestra todos
//        $arrayobj = new \ArrayObject();
//        $mesa = $this->orm->mesas->getById(5);
//        foreach( $mesa->pedidos as $pedido ) {
//            $platopedido = $pedido->platos->getRawValue();
//            $plato = $this->orm->platos->getById($platopedido);
//            $arrayobj->append($plato);
//        }
//        d($arrayobj);
        //
        //para encontrar los pedidos de una mesa dependiendo de algo
        $mesaId = 5;
        $mesa = $this->orm->mesas->getById($mesaId); // $this->orm->mesas->getBy(['nombre' => 'interior 1']);
        //los pedidos se buscan de forma independiente sabiendo la id de la mesa. Si solo sabes el nombre, la encuentras y sacas la id.
        $pedidos = $this->orm->pedidos->findBy([ 'mesa' => $mesaId, 'estado' => null ]);
        //
        $tienePedidos = count($pedidos) > 0 ? 'sí' : 'no';
        d($tienePedidos);
        //https://nextras.org/dbal/docs/3.1/query-builder
//        foreach( $pedidos as $pedido ) {
//            d($pedido->id);
//        }
//        dd('cut');
//        Lo que intento es que Mesas pedir que se muestre si la mesa tiene algo pedido y tal. En teoria en la base de datos añadido uno a mano pero me da error al
//        pasarle las entidades y demás, en si no se hacer la consulta o como seria, y llegaria a decir que he hecho algo mal en la base de datos o en el orm como tal.
//
//            }
//        }
    }
}

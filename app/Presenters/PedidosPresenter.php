<?php
declare( strict_types = 1 );

namespace App\Presenters;

use App\Model\Orm\Pedido;
use Nextras\Orm\Collection\ICollection;

final class PedidosPresenter extends BasePresenter {
    
    /** @var $pedido Pedido */
    private $pedido;
    
    public function renderDefault() {
        $this->template->pedidos = $this->orm->pedidos->findAll();
    }
    
    public function actionVer( $id ) {
        $this->pedido = $this->orm->pedidos->getById($id);
    }
    
    public function renderVer( $id ) {
        
        $this->template->pedido = $this->pedido;
    }
    
    /**
     * Preparamos el pedido si no está aún, y revisamos que esté en una mesa
     *
     * @param $id
     * @param $mesaID
     *
     * @throws \Nette\Application\AbortException
     */
    public function actionComanda( $id, $mesaID ) {
        
        //Lo primero revisar si hay mesa
        if( !$mesa = $this->orm->mesas->getById($mesaID) ) {
            $this->flashMessage("Elige una mesa antes de añadirle un nuevo pedido", 'warning');
            $this->redirect("Mesas:default");
        }
        //CARGA DEL ULTIMO PEDIO DE LA MESA
        $pedidos = $mesa->pedidos;
        foreach( $pedidos as $pedido ) {
            $id = $pedido->id;
        }
        /*
         * Comprueba si el ultimo pedido de la mesa ya esta pagado, si no lo esta muestra el ultimo pedido. Si lo esta crea uno nuevo.
         */
        if( !$pedido = $this->orm->pedidos->getById($id)->estado == 4 ) {
            $pedido = $this->orm->pedidos->getById($id);
            $this->pedido = $pedido;
        } else {
            $pedido = new Pedido();
            $pedido->mesa = $this->orm->mesas->getById($mesa->id);
            $this->pedido = $this->orm->persistAndFlush($pedido);
            $this->redirect('this', [ 'id' => $this->pedido->id ]);
        }
        //
        $this->template->mesa = $mesa;
        $this->template->platos = $this->orm->platos->findAll()->orderBy('categoria', ICollection::ASC);
    }
    
    /*
     * Cancelacion de comandas y pedidos NO TOCAR
     */
    public function actionCancelarComanda( $id ) {
        if( !$comanda = $this->orm->pedidos->getById($id) ) {
            $this->flashMessage("Ha habido un error", 'warning');
            $this->redirect("Mesas:default");
        }
        if( !$this->orm->pedidos->removeAndFlush($comanda) ) {
            $this->flashMessage("Error al eliminar la comanda", 'warning');
        } else {
            $this->flashMessage("La comanda ha sido eliminada", 'success');
        }
        $this->redirect("Mesas:default");
    }
    
    public function actionCancelarPlato( $platoID, $pedidoID, $mesaID ) {
        $plato = $this->orm->platos->getById($platoID);
        $this->pedido = $this->orm->pedidos->getById($pedidoID);
        if( !$this->pedido->platos->remove($plato) ) {
            $this->flashMessage("Error al eliminar el pedido", 'warning');
        } else {
            $this->orm->persistAndFlush($this->pedido);
            $this->flashMessage("El pedido ha sido eliminado con exito", 'success');
        }
        $this->redirect("Pedidos:Comanda", [ 'id' => $this->pedido->id, 'mesaID' => $mesaID ]);
    }
    
    /**
     * Vamos a mostrar la lista de platos, y a ir añadiendo al pedido
     *
     * @param $id
     * @param $mesaID
     */
    public function renderComanda( $platoID ) {
        
        if( $platoID ) {
            $plato = $this->orm->platos->getById($platoID);
            $this->pedido->platos->add($plato);
            $this->pedido = $this->orm->persistAndFlush($this->pedido);
        }
        //
        $this->template->pedido = $this->pedido;
    }
    
    /*
     * Cambio de estao de pedidos y mesas
     *
     * Estados de la mesa:
     *
     * 0            Libre                                   <----           Accion pagado
     * 1            Ocupada y Realizando Pedido             <----           Accion reservar
     * 2            Esperando Pedido                        <----           Accion yaPedido
     * 3            Servida                                 <----           Accion servido
     *
     * Estados de los pedidos
     *
     * 0            Esperando para realizar el pedido       <----            Accion reservar
     *                                                                                      Pedido = 0
     *                                                                                      Mesa   = 1
     * 1            Pedido realizado y esperando            <----            Accion yaPedido
     *                                                                                      Pedido = 1
     *                                                                                      Mesa   = 2
     * 2            Pedido Preparado     Solo cocina        <----            Accion preparado
     *                                                                                      Pedido = 2
     *                                                                                      Mesa   = 2
     * 3            Pedido servido                          <----            Accion servido
     *                                                                                      Pedido = 3
     *                                                                                      Mesa   = 3
     * 4            Pagado                                  <----            Accion pagado
     *                                                                                      Pedido = 4
     *                                                                                      Mesa   = 0
     *
     * Una vez el pedido esta pagado, la accion asigna el estado de la mesa a 0 (Libre)
     *
     * Cabe la posibilidad de que esto cambie
     */
    public function actionReservar( $pedidoID, $mesaID ) {
        if( $pedido = $this->orm->pedidos->getById($pedidoID) ) {
            $pedido->estado = 0;
            $this->orm->pedidos->persistAndFlush($pedido);
            $mesa = $this->orm->mesas->getById($mesaID);
            $mesa->estado = 1;
            $this->orm->mesas->persistAndFlush($mesa);
            $this->flashMessage('Se ha asignado la mesa con exito', 'success');
            $this->redirect("Pedidos:Comanda", [ 'id' => $pedidoID, 'mesaID' => $mesaID ]);
        } else {
            $this->flashMessage('Ha habido un error', 'danger');
            $this->redirect("Pedidos:Comanda", [ 'id' => $pedidoID, 'mesaID' => $mesaID ]);
        }
    }
    
    public function actionYaPedido( $pedidoID, $mesaID ) {
        if( $pedido = $this->orm->pedidos->getById($pedidoID) ) {
            $pedido->estado = 1;
            $this->orm->pedidos->persistAndFlush($pedido);
            $mesa = $this->orm->mesas->getById($mesaID);
            $mesa->estado = 2;
            $this->orm->mesas->persistAndFlush($mesa);
            $this->flashMessage('El estado del pedido se ha cambiado con exito', 'success');
            $this->redirect("Pedidos:Comanda", [ 'id' => $pedidoID, 'mesaID' => $mesaID ]);
        } else {
            $this->flashMessage('Ha habido un error', 'danger');
            $this->redirect("Pedidos:Comanda", [ 'id' => $pedidoID, 'mesaID' => $mesaID ]);
        }
    }
    
    public function actionPreparado( $pedidoID, $mesaID ) {   //Esta accion es solo para los cocineros
        if( $pedido = $this->orm->pedidos->getById($pedidoID) ) {
            $pedido->estado = 2;
            $this->orm->pedidos->persistAndFlush($pedido);
            $this->flashMessage('El estado del pedido se ha cambiado con exito', 'success');
            $this->redirect("Pedidos:Comanda", [ 'id' => $pedidoID, 'mesaID' => $mesaID ]);
        } else {
            $this->flashMessage('Ha habido un error', 'danger');
            $this->redirect("Pedidos:Comanda", [ 'id' => $pedidoID, 'mesaID' => $mesaID ]);
        }
    }
    
    public function actionServido( $pedidoID, $mesaID ) {
        if( $pedido = $this->orm->pedidos->getById($pedidoID) ) {
            $pedido->estado = 3;
            $this->orm->pedidos->persistAndFlush($pedido);
            $mesa = $this->orm->mesas->getById($mesaID);
            $mesa->estado = 3;
            $this->orm->mesas->persistAndFlush($mesa);
            $this->flashMessage('El pedido se ha asignado con exito', 'success');
            $this->redirect("Pedidos:Comanda", [ 'id' => $pedidoID, 'mesaID' => $mesaID ]);
        } else {
            $this->flashMessage('Ha habido un error', 'danger');
            $this->redirect("Pedidos:Comanda", [ 'id' => $pedidoID, 'mesaID' => $mesaID ]);
        }
    }
    
    public function actionPagado( $pedidoID, $mesaID ) {
        if( $pedido = $this->orm->pedidos->getById($pedidoID) ) {
            $pedido->estado = 4;
            $this->orm->pedidos->persistAndFlush($pedido);
            $mesa = $this->orm->mesas->getById($mesaID);
            $mesa->estado = 0;
            $this->orm->mesas->persistAndFlush($mesa);
            $this->flashMessage('El pedido se ha asignado con exito', 'success');
            $this->redirect("Pedidos:Comanda", [ 'id' => $pedidoID, 'mesaID' => $mesaID ]);
        } else {
            $this->flashMessage('Ha habido un error', 'danger');
            $this->redirect("Pedidos:Comanda", [ 'id' => $pedidoID, 'mesaID' => $mesaID ]);
        }
    }
    
    /*
     * MI GRAN DUDA
     *
     * Mi gran duda actualmente es como hacemos el tema de las cantidades de los platos en los pedidos.
     * Nada más, por lo demás te he dejado arriba un poco las acciones de actualizacion de los estados
     * de los pedidos que las he estado tocando y redactando en un comentario.
     *
     * PD: Miralo tu lo del get by
     */
}
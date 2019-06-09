<?php
declare( strict_types = 1 );

namespace App\Presenters;

use App\Model\Orm\Pedido;
use App\Model\Orm\PedidoPlato;
use App\Model\Roles;
use Nextras\Orm\Collection\ICollection;

final class TpvPresenter extends BasePresenter {
    
    /** @var $pedido Pedido */
    private $pedido = null;
    
    public function actionDefault() {
        $this->puedeAcceder(Roles::SECCION_TPV, Roles::PERMISO_VER);
    }
    
    public function renderDefault() {
        $this->template->mesas = $this->orm->mesas->findAll();
    }
    
    public function actionVer( $id ) {
        $this->puedeAcceder(Roles::SECCION_TPV, Roles::PERMISO_VER);
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
        $this->puedeAcceder(Roles::SECCION_TPV, Roles::PERMISO_PEDIDO_CREAR);
        //Lo primero revisar si hay mesa
        if( !$mesa = $this->orm->mesas->getById($mesaID) ) {
            $this->flashMessage("Elige una mesa antes de añadirle un nuevo pedido", 'warning');
            $this->redirect("tpv:default");
        }
        //
        //Carga el último pedido de la mesa
        $this->pedido = $mesa->getLastPedido();
        /*
         * Comprueba si el ultimo pedido de la mesa ya esta pagado, si no lo esta muestra el ultimo pedido. Si lo esta crea uno nuevo.
         */
        if( !$this->pedido || $this->pedido->estado == Pedido::ESTADOS['pagado'] ) {
            $pedido = new Pedido();
            $pedido->mesa = $this->orm->mesas->getById($mesa->id);
            $this->pedido = $this->orm->persistAndFlush($pedido);
            $this->redirect('this', [ 'id' => $this->pedido->id ]);
        }
        //
        $this->template->mesa = $mesa;
        $this->template->platos = $this->orm->platos->findAll()->orderBy('categoria', ICollection::ASC);
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
            $pedidoPlato = new PedidoPlato();
            $pedidoPlato->pedido = $this->pedido;
            $pedidoPlato->plato = $plato;
            $this->orm->persistAndFlush($pedidoPlato);
            $this->flashMessage('Plato añadido', 'success');
        }
        //
        $this->template->pedido = $this->pedido;
    }
    
    public function actionReservar( $pedidoID, $mesaID ) {
        $this->puedeAcceder(Roles::SECCION_TPV, Roles::PERMISO_PEDIDO_CREAR);
        //
        if( $pedido = $this->orm->pedidos->getById($pedidoID) ) {
            $pedido->estado = 0;
            $this->orm->pedidos->persistAndFlush($pedido);
            $mesa = $this->orm->mesas->getById($mesaID);
            $mesa->estado = 1;
            $this->orm->mesas->persistAndFlush($mesa);
            $this->flashMessage('Se ha asignado la mesa con exito', 'success');
            $this->redirect("Tpv:Comanda", [ 'id' => $pedidoID, 'mesaID' => $mesaID ]);
        } else {
            $this->flashMessage('Ha habido un error', 'danger');
            $this->redirect("Tpv:Comanda", [ 'id' => $pedidoID, 'mesaID' => $mesaID ]);
        }
    }
    
    public function actionYaPedido( $pedidoID, $mesaID ) {
        $this->puedeAcceder(Roles::SECCION_TPV, Roles::PERMISO_PEDIDO_CREAR);
        //
        if( $pedido = $this->orm->pedidos->getById($pedidoID) ) {
            $pedido->estado = 1;
            $this->orm->pedidos->persistAndFlush($pedido);
            $mesa = $this->orm->mesas->getById($mesaID);
            $mesa->estado = 2;
            $this->orm->mesas->persistAndFlush($mesa);
            $this->flashMessage('El estado del pedido se ha cambiado con exito', 'success');
            $this->redirect("Tpv:Comanda", [ 'id' => $pedidoID, 'mesaID' => $mesaID ]);
        } else {
            $this->flashMessage('Ha habido un error', 'danger');
            $this->redirect("Tpv:Comanda", [ 'id' => $pedidoID, 'mesaID' => $mesaID ]);
        }
    }
    
    public function actionServido( $pedidoID, $mesaID ) {
        $this->puedeAcceder(Roles::SECCION_TPV, Roles::PERMISO_PEDIDO_CREAR);
        //
        if( $pedido = $this->orm->pedidos->getById($pedidoID) ) {
            $pedido->estado = 3;
            $this->orm->pedidos->persistAndFlush($pedido);
            $mesa = $this->orm->mesas->getById($mesaID);
            $mesa->estado = 3;
            $this->orm->mesas->persistAndFlush($mesa);
            $this->flashMessage('El pedido se ha asignado con exito', 'success');
            $this->redirect("Tpv:Comanda", [ 'id' => $pedidoID, 'mesaID' => $mesaID ]);
        } else {
            $this->flashMessage('Ha habido un error', 'danger');
            $this->redirect("Tpv:Comanda", [ 'id' => $pedidoID, 'mesaID' => $mesaID ]);
        }
    }
    
    public function actionPagado( $pedidoID, $mesaID ) {
        $this->puedeAcceder(Roles::SECCION_TPV, Roles::PERMISO_PEDIDO_COBRAR);
        //
        if( $pedido = $this->orm->pedidos->getById($pedidoID) ) {
            $pedido->estado = 4;
            $this->orm->pedidos->persistAndFlush($pedido);
            $mesa = $this->orm->mesas->getById($mesaID);
            $mesa->estado = 0;
            $this->orm->mesas->persistAndFlush($mesa);
            $this->flashMessage('El pedido se ha asignado con exito', 'success');
            $this->redirect("Tpv:Comanda", [ 'id' => $pedidoID, 'mesaID' => $mesaID ]);
        } else {
            $this->flashMessage('Ha habido un error', 'danger');
            $this->redirect("Tpv:Comanda", [ 'id' => $pedidoID, 'mesaID' => $mesaID ]);
        }
    }
}
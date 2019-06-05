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
        //Buscando un metodo más facil
        //si la hay, entonces a buscar el pedido si se está editando, o crear uno nuevo
        if( $pedido = $this->orm->pedidos->getById($id) ) {
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
    
}
<?php
declare( strict_types = 1 );

namespace App\Presenters;

use App\Model\Orm\Pedido;

final class CocinaPresenter extends BasePresenter {
    
    /** @var $pedidos Pedido[] */
    private $pedidos = null;
    
    public function renderDefault() {
        if( $this->pedidos === null ) {
            $this->pedidos = $this->orm->pedidos->findPendientesCocina();
        }
        $this->template->pedidos = $this->pedidos;
    }
    
    public function handleCargarPendientes() {
        $this->pedidos = $this->orm->pedidos->findPendientesCocina();
        if( $this->isAjax() ) {
            $this->redrawControl('ultimosPedidos');
        }
    }
    
    public function actionPreparado( $pedidoID, $mesaID ) {   //Esta accion es solo para los cocineros
        if( $pedido = $this->orm->pedidos->getById($pedidoID) ) {
            $pedido->estado = 2;
            $this->orm->pedidos->persistAndFlush($pedido);
            $this->flashMessage('El estado del pedido se ha cambiado con exito', 'success');
            $this->redirect("Cocina:default");
        } else {
            $this->flashMessage('Ha habido un error', 'danger');
            $this->redirect("Cocina:default");
        }
    }
}
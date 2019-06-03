<?php
declare( strict_types = 1 );

namespace App\Presenters;

use App\Model\Orm\Mesa;
use App\Model\Orm\Pedido;
use Nextras\Orm\Collection\ICollection;

final class MesasPresenter extends BasePresenter {
    
    /** @var $mesaEditada Mesa */
    private $mesaEditada;
    
    public function renderDefault() {
        $this->template->mesas = $this->orm->mesas->findAll();
    }
    
    public function actionPedirPlato( $plato_id, $mesa_id ) {
        try {
            $pedido = new Pedido();
            $plato = $this->orm->platos->getById($plato_id);
            $mesa = $this->orm->mesas->getById($mesa_id);
            $pedido->platos->add($plato);
            $pedido->estado = '0';
            $mesa->pedidos->add($pedido);
            $this->orm->persistAndFlush($mesa);
            $this->redirect('default');
        } catch( \Exception $e ) {
            $this->flashMessage("Error al realizar el pedido, Esta disponible el plato?: " . $e->getMessage(), 'danger');
        }
    }
    
    public function actionPedir( $id ) {
        
        $pedidos = new \ArrayObject();
        $mesa = $this->orm->mesas->getById($id);
        $this->template->mesa = $mesa;
        foreach( $mesa->pedidos as $pedido ) {
            $platopedido = $pedido->platos->getRawValue();
            $plato = $this->orm->platos->getById($platopedido);
            $pedidos->append($plato);
        }
        $this->template->pedidosState = $mesa->pedidos;
        $this->template->pedidos = $pedidos;
        $this->template->platos = $this->orm->platos->findAll()->orderBy('categoria', ICollection::ASC);
        $this->template->categorias = $this->orm->categorias->findAll();
    }
    
    public function actionCancelar( $pedido_id, $mesa_id, $plato_id ) {
        try {
            $mesa = $this->orm->mesas->getById($mesa_id);
            foreach( $mesa->pedidos as $pedido ) {
                d($otro = $pedido->id);
            }
            dd($this->orm->mesas->getById($mesa_id));
            $pedido = $this->orm->pedidos->getById($pedido_id);
            $this->orm->pedidos->removeAndFlush($pedido);
            $this->redirect('default');
        } catch( \Exception $e ) {
            $this->flashMessage("Error al eliminar el pedido, Estas seguro de que existe?: " . $e->getMessage(), 'danger');
            $this->redirect('default');
        }
    }
}
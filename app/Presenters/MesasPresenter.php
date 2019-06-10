<?php
declare( strict_types = 1 );

namespace App\Presenters;

use App\Model\Orm\Mesa;
use App\Model\Orm\Pedido;
use App\Model\Roles;
use Nextras\Orm\Collection\ICollection;

final class MesasPresenter extends BasePresenter {
    
    /** @var $mesa Mesa */
    private $mesa;
    
    public function actionDefault() {
        $this->puedeAcceder(Roles::SECCION_MESAS);
    }
    
    public function renderDefault() {
        $this->template->mesas = $this->orm->mesas->findAll();
    }
    
    public function actionVer( $id ) {
        $this->puedeAcceder(Roles::SECCION_MESAS);
        $this->mesa = $this->orm->mesas->getById($id);
    }
    
    public function renderVer( $id ) {
        $this->template->mesa = $this->mesa;
        $this->template->pedidos = $this->mesa->pedidos;
    }
    
    
    
    
    ########################################
    ########################################
    ########################################
    ########################################
    ########################################
    public function actionPedirPlato( $plato_id, $mesa_id ) {
        $this->puedeAcceder(Roles::SECCION_MESAS);
        //
        $pedido = new Pedido();
        $plato = $this->orm->platos->getById($plato_id);
        $mesa = $this->orm->mesas->getById($mesa_id);
        $pedido->platos->add($plato);
        $pedido->estado = '0';
        $mesa->pedidos->add($pedido);
        $this->orm->persistAndFlush($mesa);
        $this->redirect('default');
    }
    
    public function actionPedir( $id ) {
        $this->puedeAcceder(Roles::SECCION_MESAS);
        //
        $pedidos = new \ArrayObject();
        $mesa = $this->orm->mesas->getById($id)->orderBy('id', ICollection::ASC);
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
    
    /**
     * aquí solo necesitas el plato y el pedido, una vez tienes el pedido puedes pedido->mesa->id
     */
    public function actionCancelar( $pedido_id, $mesa_id, $plato_id ) {
        $this->puedeAcceder(Roles::SECCION_MESAS);
        //
        try {
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
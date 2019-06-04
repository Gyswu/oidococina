<?php
declare( strict_types = 1 );

namespace App\Presenters;

use App\Model\Orm\Pedido;

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
        //si la hay, entonces a buscar el pedido si se está editando, o crear uno nuevo
        if( $pedido = $this->orm->pedidos->getById($id) ) {
            $this->pedido = $pedido;
        } else {
            $pedido = new Pedido();
            $pedido->mesa = $this->orm->mesas->getById($mesa->id);
            $this->pedido = $this->orm->persistAndFlush($pedido);
            $this->redirect('this', ['id' => $this->pedido->id]);
        }
        //
        $this->template->mesa = $mesa;
        $this->template->platos = $this->orm->platos->findAll();
    }
    
    /**
     * Vamos a mostrar la lista de platos, y a ir añadiendo al pedido
     *
     * @param $id
     * @param $mesaID
     */
    public function renderComanda($platoID){
        
        if($platoID){//esto muévelo a una función intermedia que te permita añadir variaciones si eso
            $plato = $this->orm->platos->getById($platoID);
            $this->pedido->platos->add($plato); //esto puede o tiene que ser movido al repositorio, pero no sé como hacerlo, así que de momento así se queda xD
            $this->pedido = $this->orm->persistAndFlush($this->pedido);
        }
        //
        $this->template->pedido = $this->pedido;
    
    }
    
    
}
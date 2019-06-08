<?php
declare( strict_types = 1 );

namespace App\Presenters;

use App\Model\Orm\Pedido;
use App\Model\Orm\PedidoPlato;
use Nextras\Orm\Collection\ICollection;

final class CocinaPresenter extends BasePresenter {
    
    /** @var $pedidos Pedido[] */
    private $pedidos = null;
    
    public function renderDefault() {
        if($this->pedidos === null){
            $this->pedidos = $this->orm->pedidos->findPendientesCocina();
        }
        
        $this->template->pedidos = $this->pedidos;
    }
    
    public function handleCargarPendientes(){
        $this->pedidos = $this->orm->pedidos->findPendientesCocina();
        if ($this->isAjax()) {
            $this->redrawControl('ultimosPedidos');
        }
    }
}
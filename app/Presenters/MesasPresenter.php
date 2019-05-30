<?php
declare( strict_types = 1 );

namespace App\Presenters;

use App\Model\Orm\Mesa;

final class MesasPresenter extends BasePresenter {
    
    /** @var $mesaEditada Mesa */
    private $mesaEditada;
    
    public function renderDefault() {
        $this->template->mesas = $this->orm->mesas->findAll();
    }
    
    public function actionPedir( $id ) {
        $mesa = $this->orm->mesas->getById($id);
        $this->mesaEditada = $mesa;
        $this->template->item = $this->orm->mesas->findById($id);
        $this->template->pedidos = $mesa->pedido;
        $this->template->mesa = $mesa;
        $platos = $this->orm->pedidos->findBy([ 'mesa' => $mesa->id ]);
        dd($this->template->platos = $platos);
    }
}
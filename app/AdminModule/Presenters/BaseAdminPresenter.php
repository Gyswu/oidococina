<?php

namespace App\AdminModule\Presenters;

use App\Model\Database\MesasModel;
use App\Model\Database\PedidosModel;
use App\Model\Database\PlatosModel;
use App\Model\Database\PlatosProductosModel;
use App\Model\Database\ProductosModel;
use App\Model\Roles;

class BaseAdminPresenter extends \App\Presenters\BasePresenter {
    
    protected $redirectLogin = true;
    
    public function startup() {
        $this->puedeAcceder(Roles::SECCION_ADMIN);
        parent::startup();
        $this->getUser()->setAuthorizator(new \App\Model\Roles());
        $this->template->usuario = $this->getDbUser();
//        if( $this->redirectLogin && ( !$this->user->loggedIn || !$this->user->isInRole('admin') ) ) {
//            $this->redirect('Sign:default');
//        }
    }
    
    public function puedeAccederAdmin( $seccion, $permiso = null ) {
        if( !$this->getUser()->isAllowed($seccion, $permiso) ) {
            $this->flashMessage('No puedes acceder a esta sección, el acceso ha sido reportado', 'danger');
            $this->redirect("Sign:in");
        }
        
        return true;
    }


//
//    public function injectModels(
//      MesasModel $mesasModel, PlatosModel $platosModel, ProductosModel $productosModel
//    ){
//     $this->mesasModel = $mesasModel;
//     $this->platosModel = $platosModel;
//     $this->productosModel = $productosModel;
//    }
}

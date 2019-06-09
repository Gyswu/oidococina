<?php

namespace App\AdminModule\Presenters;

use App\Model\Database\MesasModel;
use App\Model\Database\PlatosModel;
use App\Model\Database\ProductosModel;
use App\Model\Database\PedidosModel;
use App\Model\Database\PlatosProductosModel;
use App\Model\Roles;

class BaseAdminPresenter extends \App\Presenters\BasePresenter
{


    protected $redirectLogin = true;

    public function startup() {
        parent::startup();
        $this->puedeAcceder(Roles::SECCION_ADMIN);

//        if($this->redirectLogin && (!$this->user->loggedIn || !$this->user->isInRole('admin')) ){
//            $this->redirect('Sign:default');
//        }
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

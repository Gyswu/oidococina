<?php

namespace App\AdminModule\Presenters;

use App\Model\Database\MesasModel;
use App\Model\Database\PlatosModel;
use App\Model\Database\ProductosModel;

class BaseAdminPresenter extends \App\Presenters\BasePresenter
{

    /** @var MesasModel */
    private $mesasModel;
    /** @var PlatosModel */
    private $platosModel;
    /** @var ProductosModel */
    private $productosModel;

    protected $redirectLogin = true;

    public function startup() {
        parent::startup();
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

    /**
     * @return mixed
     */
    public function getMesasModel()
    {
        return $this->mesasModel;
    }

    public function getPlatosModel()
    {
        return $this->platosModel;
    }

    public function getProductosModel()
    {
      return $this->productosModel;
    }


}

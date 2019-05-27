<?php

namespace App\AdminModule\Presenters;

use App\Model\Database\MesasModel;
use App\Model\Database\PlatosModel;
use App\Model\Database\ProductosModel;
use App\Model\Database\PedidosModel;
use App\Model\Database\PlatosProductosModel;

class BaseAdminPresenter extends \App\Presenters\BasePresenter
{

    /** @var MesasModel */
    private $mesasModel;
    /** @var PlatosModel */
    private $platosModel;
    /** @var ProductosModel */
    private $productosModel;
    /** @var PedidosModel */
    private $pedidosModel;
    /** @var PlatosProductosModel */
    private $platosProductosModel;

    protected $redirectLogin = true;

    public function startup() {
        parent::startup();
//        if($this->redirectLogin && (!$this->user->loggedIn || !$this->user->isInRole('admin')) ){
//            $this->redirect('Sign:default');
//        }
    }


    public function injectModels(
      MesasModel $mesasModel, PlatosModel $platosModel, ProductosModel $productosModel, PedidosModel $pedidosModel, PlatosProductosModel $platosProductosModel
    ){
     $this->mesasModel = $mesasModel;
     $this->platosModel = $platosModel;
     $this->productosModel = $productosModel;
     $this->pedidosModel = $pedidosModel;
     $this->platosProductosModel = $platosProductosModel;
    }

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
    public function getPedidosModel()
    {
      return $this->pedidosModel;
    }
    public function getPlatosProductos()
    {
      return $this->platosProductosModel;
    }


}

<?php

namespace App\AdminModule\Presenters;

use App\Model\Database\MesasModel;

class BaseAdminPresenter extends \App\Presenters\BasePresenter
{

    /** @var MesasModel */
    private $mesasModel;

    protected $redirectLogin = true;

    public function startup() {
        parent::startup();
//        if($this->redirectLogin && (!$this->user->loggedIn || !$this->user->isInRole('admin')) ){
//            $this->redirect('Sign:default');
//        }
    }


    public function injectModels( MesasModel $mesasModel){
     $this->mesasModel = $mesasModel;
    }

    /**
     * @return mixed
     */
    public function getMesasModel()
    {
        return $this->mesasModel;
    }


}

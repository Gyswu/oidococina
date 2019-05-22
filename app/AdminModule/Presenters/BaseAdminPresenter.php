<?php

namespace App\AdminModule\Presenters;

class BaseAdminPresenter extends \App\Presenters\BasePresenter
{

    protected $redirectLogin = true;

    public function startup() {
        parent::startup();
//        if($this->redirectLogin && (!$this->user->loggedIn || !$this->user->isInRole('admin')) ){
//            $this->redirect('Sign:default');
//        }
    }
}

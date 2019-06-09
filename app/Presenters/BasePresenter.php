<?php
declare( strict_types = 1 );

namespace App\Presenters;

use App\Model\Menu;
use App\Model\Orm;
use Nette;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter {
    
    /** @var Orm\Orm @inject */
    public $orm;
    
    protected function startup() {
//        dd($this->getUser());
        $this->getUser()->setAuthorizator(new \App\Model\Roles());
        if( !$this->user->isLoggedIn() && !in_array($this->presenter->getName(), [ 'Sign' ]) ) {
            $this->flashMessage('Debes iniciar sesión primero');
            $this->redirect(':Sign:in');
    
        }
        parent::startup();
        //
        $this->template->usuario = $this->getDbUser();
        $this->template->menu = Menu::getMenu($this->getUser());
    }
    
    /**
     * Usuario de la base de datos una vez conectado
     *
     * @return Orm\Usuario|NULL
     */
    protected function getDbUser() {
        return $this->orm->usuarios->getById($this->user->getId());
    }
    
    /**
     * Devuelve si el acceso está permitido al pasar la sección y el permiso
     * Utiliza el usuario conectado actual para determinar su rol.
     * Si el permiso está vacío permite acceso a toda la sección indicada.
     *
     * Se basa en el modelo Roles para los permisos
     *
     * @param      $seccion
     * @param null $permiso
     *
     * @return bool
     */
    public function puedeAcceder( $seccion, $permiso = null ) {
        if(!$this->getUser()->isAllowed($seccion, $permiso)){
            $this->flashMessage('No puedes acceder a esta sección, el acceso ha sido reportado','danger');
            if($this->user->isLoggedIn()){
                $this->redirect(":Homepage:default");
            }
            $this->redirect(":Sign:in");
        }
        return true;
    }
    
}

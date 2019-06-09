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
        if( !$this->getUser()->isAllowed($seccion, $permiso) ) {
            $this->flashMessage('No puedes acceder a esta sección, el acceso ha sido reportado', 'danger');
            $this->redirect("Sign:in");
        }
        
        return true;
    }
    
    protected function startup() {
        if( !$this->user->isLoggedIn() && !in_array($this->presenter->getName(), [ 'Sign', 'Admin:Sign' ]) ) {
            $this->flashMessage('Debes iniciar sesión primero');
            $this->redirect('Sign:in');
        }
        parent::startup();
        $this->getUser()->setAuthorizator(new \App\Model\Roles());
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
    
}

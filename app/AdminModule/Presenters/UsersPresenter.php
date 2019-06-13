<?php

namespace App\AdminModule\Presenters;

use App\Forms\UsersFormFactory;
use App\Model\Orm\Usuario;
use Nette\Application\UI\Form;

class UsersPresenter extends BaseAdminPresenter {
    
    /** @var $usuarioEditado Usuario */
    private $usuarioEditado;
    
    public function renderDefault(): void {
        $this->template->usuariosx = $this->orm->usuarios->findAll();
    }
    
    public function createComponentMasUsuariosForm() {
        
        $form = ( new UsersFormFactory() )->create();
        $form->onSuccess[] = [ $this, 'onSuccessMasUsuarios' ];
        
        return $form;
    }
    
    public function onSuccessMasUsuarios( Form $form, \stdClass $values ): void {
        
        $usuario = new Usuario();
        $usuario->nombre = $values->nombre;
        $usuario->pin = $values->pin;
        $usuario->rol = $values->rol;
        try {
            $this->orm->usuarios->persistAndFlush($usuario);
            $this->flashMessage('Usuario creado correctamente', 'success');
        } catch( \Exception $e ) {
            $this->flashMessage("Error: " . $e->getMessage(), 'danger');
        }
        $this->redirect('this');
    }
    
    public function actionBorrar( $userID ) {
        try {
            if( !$user = $this->orm->usuarios->getById($userID) ) {
                $this->flashMessage("La mesa no existe", "danger");
            };
            $this->orm->usuarios->removeAndFlush($user);
            $this->flashMessage("Mesa eliminado", "success");
        } catch( \Exception $e ) {
            $this->flashMessage("Error al eliminar la mesa, ¿Es una id válida?: " . $e->getMessage(), 'danger');
        }
        $this->redirect('default');
    }
    
}
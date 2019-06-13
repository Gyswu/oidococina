<?php

namespace App\AdminModule\Presenters;

use App\Forms\MesasFormFactory;
use App\Model\Orm\Mesa;
use Nette\Application\UI\Form;

class MesasPresenter extends BaseAdminPresenter {
    
    /** @var $mesaEditada Mesa */
    private $mesaEditada;
    
    public function renderDefault(): void {
        $this->template->mesas = $this->orm->mesas->findAll();
    }
    
    public function createComponentMasMesasForm() {
        
        $form = ( new MesasFormFactory() )->create();
        $form->onSuccess[] = [ $this, 'onSuccessMasMesas' ];
        
        return $form;
    }
    
    public function onSuccessMasMesas( Form $form, \stdClass $values ): void {
        
        $mesa = new Mesa();
        $mesa->nombre = $values->nombre;
        try {
            $mesaNueva = $this->orm->mesas->persistAndFlush($mesa);
            $this->flashMessage('Mesa guardada correctamente', 'success');
        } catch( \Exception $e ) {
            $this->flashMessage("Error: " . $e->getMessage(), 'danger');
        }
        $this->redirect('this');
    }
    
    public function actionEditar( $id ) {
        $mesa = $this->orm->mesas->getById($id);
        $this->mesaEditada = $mesa;
        $this->template->item = $this->orm->mesas->findById($id);
    }
    
    public function createComponentEditarMesaForm() {
        
        $form = ( new MesasFormFactory() )->createEdit($this->mesaEditada);
        $form->onSuccess[] = [ $this, 'onSuccessEditarMesa' ];
        
        return $form;
    }
    
    public function onSuccessEditarMesa( Form $form, \stdClass $values ) {
        
        try {
            $mesa = $this->mesaEditada;
            $mesa->nombre = $values->nombre;
            $this->orm->mesas->persistAndFlush($mesa);
            $this->flashMessage("Mesa editada correctamente", "success");
        } catch( \Exception $e ) {
            $this->flashMessage("Error al editar", 'danger');
        }
        $this->redirect("this");
    }
    
    public function actionBorrar( $id ) {
        try {
            if( !$mesa = $this->orm->mesas->getById($id) ) {
                $this->flashMessage("La mesa no existe", "danger");
            };
            $this->orm->mesas->removeAndFlush($mesa);
            $this->flashMessage("Mesa eliminado", "success");
        } catch( \Exception $e ) {
            $this->flashMessage("Error al eliminar la mesa, ¿Es una id válida?: " . $e->getMessage(), 'danger');
        }
        $this->redirect('default');
    }
    
}

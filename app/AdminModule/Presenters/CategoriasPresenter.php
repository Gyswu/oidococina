<?php

namespace App\AdminModule\Presenters;

use App\Forms\CategoriasFormFactory;
use App\Model\Orm\Categoria;
use Nette\Application\UI\Form;

class CategoriasPresenter extends BaseAdminPresenter {
    
    /** @var $categoriaEditada Categoria */
    private $categoriaEditada;
    
    public function renderDefault(): void {
        $this->template->categorias = $this->orm->categorias->findAll();
    }
    
    public function createComponentMasCategoriasForm() {
        
        $form = ( new CategoriasFormFactory() )->create();
        $form->onSuccess[] = [ $this, 'onSuccessMasCategorias' ];//convención con la variable onSuccess y el nombre del formulario
        
        return $form;
    }
    
    public function onSuccessMasCategorias( Form $form, \stdClass $values ): void {
        
        try {
            $categoria = new Categoria();
            $categoria->nombre = $values->nombre;
            $this->orm->persistAndFlush($categoria);
            $this->flashMessage('La categoira ha sido añadida a la base de datos', 'success');
        } catch( \Exception $e ) {
            $this->flashMessage("Error: " . $e->getMessage(), 'danger');
        }
        $this->redirect('this');
    }
}

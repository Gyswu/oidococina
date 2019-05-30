<?php

namespace App\AdminModule\Presenters;

use App\Forms\FormFactory;
use App\Forms\MenusFormFactory;
use App\Model\Orm\Menu;
use Nette\Application\UI\Form;

class MenusPresenter extends BaseAdminPresenter {
    
    /** @var $menuEditado Menu */
    private $menuEditado;
    
    public function renderDefault(): void {
        $this->template->menus = $this->orm->menus->findAll();
    }
    
    public function createComponentMasMenusForm() {
        
        $form = ( new FormFactory() )->create();
        $form->addText('nombre', 'Nombre del menu')
             ->setRequired();
        $form->addText('precio', 'Precio del menu')
             ->setRequired()
             ->addRule(Form::FLOAT, 'Debe ser un numero')
             ->setHtmlAttribute("step", '.01');
        $form->addSubmit('send', 'Añadir')
             ->setHtmlAttribute("class", 'btn btn-success');
        $form->onSuccess[] = [ $this, 'onSuccessMasMenus' ];
        
        return $form;
    }
    
    public function onSuccessMasMenus( Form $form, \stdClass $values ): void {
        
        
        try {
            $menu = new Menu();
            $menu->nombre = $values->nombre;
            $menu->precio = $values->precio;
            $this->orm->persistAndFlush($menu);
            $this->flashMessage('El menu ha sido añadido a la base de datos', 'success');
        } catch( \Exception $e ) {
            $this->flashMessage("Algo no ha salido bien al añadir el menu", 'danger');
        }
        $this->redirect('this');
    }
    
    public function actionEditar( $id ) {
        $menu = $this->orm->menus->getById($id);
        $this->menuEditado = $menu;
        //
        $this->template->item = $menu;
        $this->template->platos = $menu->platos;
        $this->template->mesa = $menu;
    }
    
    public function createComponentEditarMenuForm() {
        
        $form = ( new MenusFormFactory() )->createEdit($this->menuEditado);
        $form->onSuccess[] = [ $this, 'onSuccessEditarMenu' ];//convención con la variable onSuccess y el nombre del formulario
        
        return $form;
    }
    
    public function onSuccessEditarMenu( Form $form, \stdClass $values ) {
        try {
            $menu = $this->menuEditado;
            $menu->nombre = $values->nombre;
            $menu->precio = $values->precio;
            $this->orm->persistAndFlush($menu);
            $this->flashMessage("Producto editado correctamente", "success");
        } catch( \Exception $e ) {
            $this->flashMessage("Error al editar", 'danger');
        }
        $this->redirect("this");
    }
    
    public function createComponentMasPlatosForm() {
        $form = ( new FormFactory() )->create();
        $form->addSelect('plato', 'Plato', $this->orm->platos->findAll()->fetchPairs('id', 'nombre'));
        $form->addText('cantidad', 'Cantidad')
             ->addRule(FORM::INTEGER, 'Debe ser un numero entero')
             ->setRequired();
        $form->addSubmit('send', 'Añadir')
             ->setHtmlAttribute("class", 'btn btn-success');
        $form->onSuccess[] = [ $this, 'onSuccessMasPlatos' ];
        
        return $form;
    }
    
    public function onSuccessMasPlatos( Form $form, \stdClass $values ) {
        try {
            
            $plato = $this->orm->platos->getById($values->plato);
            $this->menuEditado->platos->add($plato);
            $this->orm->persistAndFlush($this->menuEditado);
            $this->flashMessage('El plato ha sido añadido a la base de datos', 'success');
        } catch( \Exception $e ) {
            $this->flashMessage("Error: " . $e->getMessage(), 'danger');
        }
        $this->redirect('this');
    }
    
    public function actionBorrar( $id ) {
        try {
            if( !$menu = $this->orm->menus->findById($id) ) {
                $this->flashMessage("Menu no encontrado", "danger");
            };
            $this->orm->menus->removeAndFlush($menu);
            $this->flashMessage("Menu eliminado", "success");
        } catch( \Exception $e ) {
            $this->flashMessage("Error al eliminar el menu, ¿Es una id válida?: " . $e->getMessage(), 'danger');
        }
        $this->redirect('default');
    }
    
    public function actionBorrarPlato( $id, $idMenu ) {
        try {
            if( !$plato = $this->orm->platos->getById($id) ) {
                $this->flashMessage("Ingrediente no encontrado", "danger");
            };
            $plato = $this->orm->platos->getById($id);
            $menu = $this->orm->menus->getById($idMenu);
            $menu->platos->remove($plato->id);
            $this->orm->persistAndFlush($plato);
            $this->flashMessage("Producto eliminado", "success");
        } catch( \Exception $e ) {
            $this->flashMessage("Error al eliminar producto, ¿Es una id válida?: " . $e->getMessage(), 'danger');
        }
        $this->redirect('default');
    }
}
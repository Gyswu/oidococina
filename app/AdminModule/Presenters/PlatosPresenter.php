<?php

namespace App\AdminModule\Presenters;

use App\Forms\FormFactory;
use App\Forms\PlatosFormFactory;
use App\Model\Orm\Categoria;
use App\Model\Orm\Ingrediente;
use App\Model\Orm\Plato;
use Nette\Application\UI\Form;

class PlatosPresenter extends BaseAdminPresenter {
    
    /** @var $platoEditado Plato */
    private $platoEditado;
    /** @var $categorias Categoria */
    private $categorias;
    
    public function renderDefault(): void {
        $this->template->platos = $this->orm->platos->findAll();
    }
    
    public function createComponentMasPlatosForm() {
        
        $form = ( new FormFactory() )->create();
        $form->addText('nombre', 'Nombre del plato')
             ->setRequired();
        $form->addText('precio', 'Precio del plato')
             ->setRequired()
             ->addRule(Form::FLOAT, 'Debe ser un numero')
             ->setHtmlAttribute("step", '.01');
        $form->addSelect('category', 'Categoria', $this->orm->categorias->findAll()->fetchPairs('id', 'nombre'));
        $form->addSubmit('send', 'Añadir')
             ->setHtmlAttribute("class", 'btn btn-success');
        $form->onSuccess[] = [ $this, 'onSuccessMasPlatos' ];
        
        return $form;
    }
    
    public function onSuccessMasPlatos( Form $form, \stdClass $values ): void {
        
        
        try {
            $plato = new Plato();
            $plato->nombre = $values->nombre;
            $plato->precio = $values->precio;
            $categoria = new Categoria();
            $cat = $values->category;
            $categoria = $this->orm->categorias->getById($cat);
            $categoria->platos->add($plato);
            $this->orm->persistAndFlush($categoria);
            $this->flashMessage('El plato ha sido añadido a la base de datos', 'success');
        } catch( \Exception $e ) {
            $this->flashMessage("Error: " . $e->getMessage(), 'danger');
        }
        $this->redirect('this');
    }
    
    public function actionEditar( $id ) {
        $plato = $this->orm->platos->getById($id);
        $this->platoEditado = $plato;
        //
        $this->template->item = $plato;
        $this->template->ingredientes = $plato->ingredientes;
        $this->template->plato = $plato;
    }
    
    public function createComponentEditarPlatoForm() {
        
        $masCategorias = new Categoria();
        $masCategorias = $this->orm->categorias->findAll()->fetchPairs('id', 'nombre');
        $form = ( new PlatosFormFactory() )->createEdit($this->platoEditado, $masCategorias);
        $form->onSuccess[] = [ $this, 'onSuccessEditarPlato' ];//convención con la variable onSuccess y el nombre del formulario
        
        return $form;
    }
    
    public function onSuccessEditarPlato( Form $form, \stdClass $values ) {
        
        try {
            $plato = $this->platoEditado;
            $plato->nombre = $values->nombre;
            $plato->precio = $values->precio;
            $cat = $values->category;
            $categoria = new Categoria();
            $categoria = $this->orm->categorias->getById($cat);
            $categoria->platos->add($plato);
            $this->orm->persistAndFlush($categoria);
            $this->flashMessage("Producto editado correctamente", "success");
        } catch( \Exception $e ) {
            $this->flashMessage("Error al editar", 'danger');
        }
        $this->redirect("this");
    }
    
    public function createComponentMasIngredientesForm() {
        $form = ( new FormFactory() )->create();
        $form->addSelect('ingrediente', 'Ingrediente', $this->orm->productos->findAll()->fetchPairs('id', 'nombre'));
        $form->addText('cantidad', 'Cantidad')
             ->addRule(FORM::INTEGER, 'Debe ser un numero entero')
             ->setRequired();
        $form->addSubmit('send', 'Añadir')
             ->setHtmlAttribute("class", 'btn btn-success');
        $form->onSuccess[] = [ $this, 'onSuccessMasIngredientes' ];
        
        return $form;
    }
    
    public function onSuccessMasIngredientes( Form $form, \stdClass $values ): void {
        
        try {
            
            $producto = $this->orm->productos->getById($values->ingrediente);
            //
            $ingrediente = new Ingrediente();
            $ingrediente->cantidad = $values->cantidad;
            $ingrediente->producto = $producto;
            $ingredienteCreado = $this->orm->persist($ingrediente);
            //
            $this->platoEditado->ingredientes->add($ingredienteCreado);
            $this->orm->persistAndFlush($this->platoEditado);
            $this->flashMessage('El plato ha sido añadido a la base de datos', 'success');
        } catch( \Exception $e ) {
            $this->flashMessage("Error: " . $e->getMessage(), 'danger');
        }
        $this->redirect('this');
    }
    
    public function actionBorrar( $id ) {
        try {
            if( !$plato = $this->orm->platos->getById($id) ) {
                $this->flashMessage("Plato no encontrado", "danger");
            };
            $this->orm->platos->removeAndFlush($plato);
            $this->flashMessage("Plato eliminado", "success");
        } catch( \Exception $e ) {
            $this->flashMessage("Error al eliminar plato, ¿Es una id válida?: " . $e->getMessage(), 'danger');
        }
        $this->redirect('default');
    }
    
    public function actionBorrarIngrediente( $id, $idPlato ) {
        try {
            
            if( !$ingrediente = $this->orm->ingredientes->getById($id) ) {
                $this->flashMessage("Ingrediente no encontrado", "danger");
            };
            $ingrediente = $this->orm->ingredientes->getById($id);
            $plato = $this->orm->platos->getById($idPlato);
            $plato->ingredientes->remove($ingrediente->id);
            $this->orm->persistAndFlush($ingrediente);
            $this->flashMessage("Producto eliminado", "success");
        } catch( \Exception $e ) {
            $this->flashMessage("Error al eliminar producto, ¿Es una id válida?: " . $e->getMessage(), 'danger');
        }
        $this->redirect('default');
    }
    
    /*
     * Habilitacion o deshabilitacion de disponibilidad de platos
     *
     * Estado
     *
     *      1 -> Disponible
     *      0 -> No Disponible
     */
    public function actionHabilitar( $platoID ) {
        $plato = $this->orm->platos->getById($platoID);
        $plato->disponible = 1;
        if( $this->orm->platos->persistAndFlush($plato) ) {
            
            $this->flashMessage("Plato habilitado", "success");
        } else {
            $this->flashMessage("Error al habilitar", 'danger');
        }
        $this->redirect('default');
    }
    
    public function actionDeshabilitar( $platoID ) {
        $plato = $this->orm->platos->getById($platoID);
        $plato->disponible = 0;
        if( $this->orm->platos->persistAndFlush($plato) ) {
            
            $this->flashMessage("Plato deshabilitado", "success");
        } else {
            $this->flashMessage("Error al deshabilitar", 'danger');
        }
        $this->redirect('default');
    }
}

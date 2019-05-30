<?php

namespace App\AdminModule\Presenters;

use App\Forms\FormFactory;
use App\Forms\ProductosFormFactory;
use App\Model\Orm\Producto;
use Nette\Application\UI\Form;

class ProductosPresenter extends BaseAdminPresenter {
    
    /** @var $productoEditado Producto */
    private $productoEditado;
    
    public function renderDefault(): void {
        $this->template->productos = $this->orm->productos->findAll();
    }
    
    public function createComponentMasProductosForm() {
        
        $form = ( new FormFactory() )->create();
        $form->addText('nombre', 'Nombre del producto')
             ->setRequired();
        $form->addText('categoria', 'Categoria del producto');
        $form->addText('cantidad', 'Cantidad')
             ->addRule(Form::INTEGER, 'Ha de ser un numero entero');
        $form->addSelect('unidad', 'Unidad', [
            'num' => 'Unidades',
            'ml'  => 'Mililitros',
            'gr'  => 'Gramos',
        ]);
        $form['unidad']->setDefaultValue('num');
        $form->addSubmit('send', 'Añadir')
             ->setHtmlAttribute("class", 'btn btn-success');
        $form->onSuccess[] = [ $this, 'onSuccessMasProductos' ];//convención con la variable onSuccess y el nombre del formulario
        
        return $form;
    }
    
    public function onSuccessMasProductos( Form $form, \stdClass $values ): void {
        
        try {
            $producto = new Producto();
            $producto->nombre = $values->nombre;
            $producto->categoria = $values->categoria;
            $producto->stock = $values->cantidad;
            $producto->unidad = $values->unidad;
            $this->orm->persistAndFlush($producto);
            $this->flashMessage('El producto ha sido añadido a la base de datos', 'success');
        } catch( \Exception $e ) {
            $this->flashMessage("Error: " . $e->getMessage(), 'danger');
        }
        $this->redirect('this');
    }
    
    public function actionEditar( $id ) {
        $producto = $this->orm->platos->getById($id);
        $this->productoEditado = $producto;
        $this->template->item = $producto;
    }
    
    public function createComponentEditarProductosForm() {
        $producto = $this->productoEditado;
        $form = ( new ProductosFormFactory() )->createEdit($producto->toArray());
        $form->onSuccess[] = [ $this, 'onSuccessEditarProducto' ];
        
        return $form;
    }
    
    public function onSuccessEditarProducto( Form $form, \stdClass $values ) {
        
        try {
            $producto = $this->productoEditado;
            $producto->nombre = $values->nombre;
            $producto->categoria = $values->categoria;
            $producto->stock = $values->cantidad;
            $producto->unidad = $values->unidad;
            $this->orm->persistAndFlush($producto);
            $this->flashMessage("Producto editado correctamente", "success");
        } catch( \Exception $e ) {
            $this->flashMessage("Error al editar", 'danger');
        }
        $this->redirect("this");
    }
    
    public function actionBorrar( $id ) {
        try {
            if( !$producto = $this->orm->productos->getById($id) ) {
                $this->flashMessage("producto no encontrado", "Danger");
            };
            $this->flashMessage("Producto eliminado", "success");
        } catch( \Exception $e ) {
            $this->flashMessage("Error al eliminar el producto, ¿Es una id válida?: " . $e->getMessage(), 'danger');
        }
        $this->redirect('default');
    }
    
}

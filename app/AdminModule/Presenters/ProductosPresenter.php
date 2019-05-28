<?php

namespace App\AdminModule\Presenters;


use App\Forms\FormFactory;
use App\Forms\ProductosFormFactory;
use App\Model\Database\Entities\Producto;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IComponent;
use Nette\Database\Table\ActiveRow;

class ProductosPresenter extends BaseAdminPresenter
{

    public function renderDefault(): void
    {
        $this->template->productos = $this->getProductosModel()->findAll();
    }


    public function createComponentMasProductosForm()
    {

        $form = (new FormFactory())->create();

        $form->addText('nombre', 'Nombre del producto')
            ->setRequired();
        $form->addText('categoria', 'Categoria del producto');
        $form->addText('cantidad', 'Cantidad')
             ->addRule(Form::INTEGER, 'Ha de ser un numero entero');
        $form->addSelect('unidad', 'Unidad',[
          'num' => 'Unidades',
          'ml' => 'Mililitros',
          'gr' => 'Gramos',
        ]);
        $form['unidad']->setDefaultValue('num');

        $form->addSubmit('send', 'Añadir')
            ->setHtmlAttribute("class", 'btn btn-success');

        $form->onSuccess[] = [$this, 'onSuccessMasProductos'];//convención con la variable onSuccess y el nombre del formulario

        return $form;

    }


    public function onSuccessMasProductos(Form $form, \stdClass $values): void
    {

        $producto = new Producto();
        $producto->nombre = $values->nombre;
        $producto->categoria = $values->categoria;
        $producto->cantidad = $values->cantidad;
        $producto->unidad = $values->unidad;


        try {
            $productoNuevo = $this->getProductosModel()->newProducto($producto);
            $this->flashMessage('El producto ha sido añadido a la base de datos', 'success');
        } catch (\Exception $e) {
            $this->flashMessage($e->getMessage(), 'danger');
        }

        $this->redirect('this');

    }

    public function actionEditar($id)
    {
        $this->template->item = $this->getProductosModel()->findById($id);
    }

    public function createComponentEditarProductosForm()
    {
        $producto = $this->template->item;
        $form = (new ProductosFormFactory())->createEdit($producto->toArray());

        $form->onSuccess[] = [$this, 'onSuccessEditarProducto'];

        return $form;
    }

    public function onSuccessEditarProducto(Form $form, \stdClass $values)
    {

        try {
            $producto = $this->template->item;
            $producto->update((array)$values);
            $this->flashMessage("Produco editado correctamente", "success");
        } catch (\Exception $e) {
            $this->flashMessage("Error al editar", 'danger');
        }

        $this->redirect("this");
    }

    public function actionBorrar($id)
    {
        try {
            if (!$producto = $this->getProductosModel()->findById($id)) {
                throw new \Exception("producto no encontrado");
            };
            $producto->delete();
            $this->flashMessage("Producto eliminado", "success");
        } catch (\Exception $e) {
            $this->flashMessage("Error al eliminar el producto, ¿Es una id válida?: " . $e->getMessage(), 'danger');
        }

        $this->redirect('default');
    }

}

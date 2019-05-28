<?php

namespace App\AdminModule\Presenters;


use App\Forms\FormFactory;
use App\Forms\PlatosFormFactory;
use App\Model\Database\Entities\Plato;
use App\Model\Database\Entities\PlatoProducto;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IComponent;
use Nette\Database\Table\ActiveRow;

class PlatosPresenter extends BaseAdminPresenter
{

    public function renderDefault(): void
    {
        $this->template->platos = $this->getPlatosModel()->findAll();
    }


    public function createComponentMasPlatosForm()
    {

        $form = (new FormFactory())->create();

        $form->addText('nombre', 'Nombre del plato')
            ->setRequired();
        $form->addText('precio', 'Precio del plato')
            ->setRequired()
            ->addRule(Form::FLOAT, 'Debe ser un numero')
            ->setHtmlAttribute("step", '.01');

        $form->addSubmit('send', 'Añadir')
            ->setHtmlAttribute("class", 'btn btn-success');

        $form->onSuccess[] = [$this, 'onSuccessMasPlatos'];//convención con la variable onSuccess y el nombre del formulario
        //$form->addSelect('producto','Producto',$this->getPlatosModel()->findAllPairs("id","nombre"));
        return $form;

    }


    public function onSuccessMasPlatos(Form $form, \stdClass $values): void
    {

        $plato = new Plato();
        $plato->nombre = $values->nombre;
        $plato->precio = $values->precio;

        try {
            $platoNuevo = $this->getPlatosModel()->newPlato($plato);
            $this->flashMessage('El plato ha sido añadido a la base de datos', 'success');
        } catch (\Exception $e) {
            $this->flashMessage($e->getMessage(), 'danger');
        }

        $this->redirect('this');

    }

    public function actionEditar($id)
    {
        $plato = $this->getPlatosModel()->findById($id);
        $this->template->item = $plato;
        $this->template->productos = $this->getPlatosModel()->getProductos($plato->toArray());
    }

    public function createComponentEditarPlatoForm()
    {
        $plato = $this->template->item;
        $form = (new PlatosFormFactory())->createEdit($plato->toArray());

        $form->onSuccess[] = [$this, 'onSuccessEditarPlato'];//convención con la variable onSuccess y el nombre del formulario

        return $form;
    }

    public function onSuccessEditarPlato(Form $form, \stdClass $values)
    {

        try {
            $plato = $this->template->item;
            $plato->update((array)$values);
            $this->flashMessage("Producto editado correctamente", "success");
        } catch (\Exception $e) {
            $this->flashMessage("Error al editar", 'danger');
        }

        $this->redirect("this");
    }

    /**
     * Para borrar un plato solo hace falta la id, encontrarlo, y si todo va bien borrarlo
     */
    public function actionBorrar($id)
    {
        try {
            if (!$plato = $this->getPlatosModel()->findById($id)) {
                throw new \Exception("plato no encontrado");
            };
            $plato->delete();
            $this->flashMessage("Plato eliminado", "success");
        } catch (\Exception $e) {
            $this->flashMessage("Error al eliminar plato, ¿Es una id válida?: " . $e->getMessage(), 'danger');
        }

        $this->redirect('default');
    }

    public function createComponentMasPlatosProductosForm() {
        $form = (new FormFactory())->create();
        $form->addSelect('producto','Producto',$this->getProductosModel()->findAllPairs("id","nombre"));
        $form->addText('cantidad','Cantidad')
          ->addRule(FORM::INTEGER, 'Debe ser un numero entero')
          ->setRequired();
        $form->addSubmit('send', 'Añadir')
          ->setHtmlAttribute("class", 'btn btn-success');

        $form->onSuccess[] = [$this, 'onSuccessMasPlatosProductos'];
        return $form;
    }
    public function onSuccessMasPlatosProductos(Form $form, \stdClass $values): void
    {
        $plato = $this->template->item;

        $platoproducto = new PlatoProducto();
        $platoproducto->plato = $plato->id;
        $platoproducto->producto = $values->producto;
        $platoproducto->cantidad = $values->cantidad;

        $newPlatoProducto = (array)$platoproducto;

        try {
            $platoproductoNuevo = $this->getPlatosModel()->newPlatoProducto($newPlatoProducto);
            $this->flashMessage('El plato ha sido añadido a la base de datos', 'success');
        } catch (\Exception $e) {
            $this->flashMessage($e->getMessage(), 'danger');
        }

        $this->redirect('this');

    }
    public function actionBorrarProducto($id)
    {
        try {
            if (!$producto = $this->getPlatosProductos()->findById($id)) {
                throw new \Exception("plato no encontrado");
            };
            $producto->delete();
            $this->flashMessage("Producto eliminado", "success");
        } catch (\Exception $e) {
            $this->flashMessage("Error al eliminar producto, ¿Es una id válida?: " . $e->getMessage(), 'danger');
        }

        $this->redirect('default');
    }

}

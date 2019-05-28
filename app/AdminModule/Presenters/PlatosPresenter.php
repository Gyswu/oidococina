<?php

namespace App\AdminModule\Presenters;


use App\Forms\FormFactory;
use App\Forms\PlatosFormFactory;
use App\Model\Orm\Plato;
use App\Model\Orm\Ingrediente;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IComponent;
use Nette\Database\Table\ActiveRow;

class PlatosPresenter extends BaseAdminPresenter
{

    /** @var $platoEditado Plato */
    private $platoEditado;

    public function renderDefault(): void
    {
        $this->template->platos = $this->orm->platos->findAll();
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

        $form->onSuccess[] = [$this, 'onSuccessMasPlatos'];
        return $form;

    }


    public function onSuccessMasPlatos(Form $form, \stdClass $values): void
    {


        try {
            $plato = new Plato();
            $plato->nombre = $values->nombre;
            $plato->precio = $values->precio;
//            $platoNuevo = $this->getPlatosModel()->newPlato($plato);
            $this->orm->persistAndFlush($plato);
            $this->flashMessage('El plato ha sido añadido a la base de datos', 'success');
        } catch (\Exception $e) {
            $this->flashMessage($e->getMessage(), 'danger');
        }

        $this->redirect('this');

    }

    public function actionEditar($id)
    {
        $plato = $this->orm->platos->getById($id);
        $this->platoEditado = $plato;
        //
        $this->template->item = $plato;
        $this->template->ingredientes = $plato->ingredientes; //$this->getPlatosModel()->getProductos($plato->toArray());
    }

    public function createComponentEditarPlatoForm()
    {

        $form = (new PlatosFormFactory())->createEdit($this->platoEditado);

        $form->onSuccess[] = [$this, 'onSuccessEditarPlato'];//convención con la variable onSuccess y el nombre del formulario

        return $form;
    }

    public function onSuccessEditarPlato(Form $form, \stdClass $values)
    {

        try {
            $plato = $this->platoEditado;
            $plato->nombre = $values->nombre;


            $this->orm->persistAndFlush($plato);
            $this->flashMessage("Producto editado correctamente", "success");
        } catch (\Exception $e) {
            $this->flashMessage("Error al editar", 'danger');
        }

        $this->redirect("this");
    }

    public function createComponentMasPlatosProductosForm() {
        $plato = $this->platoEditado->id;
        $form = (new FormFactory())->create();
        $form->addSelect('ingrediente','Ingrediente',$this->orm->productos->findAll()->fetchPairs('id', 'nombre'));
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

        try {

            $producto = $this->orm->productos->getById($values->ingrediente);

            $ingrediente = new Ingrediente();
            $ingrediente->cantidad = $values->cantidad;

            $ingrediente->producto = $producto;

            $ingredienteCreado = $this->orm->persist($ingrediente);

            $plato = new Plato();
            $plato = $this->platoEditado;

            $plato->ingredientes->add($ingredienteCreado);

            $this->orm->ingredientes->persistAndFlush($this->platoEditado);
            $this->flashMessage('El plato ha sido añadido a la base de datos', 'success');
        } catch (\Exception $e) {
            $this->flashMessage($e->getMessage(), 'danger');
        }

        $this->redirect('this');

    }
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

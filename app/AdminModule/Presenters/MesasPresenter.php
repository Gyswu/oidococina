<?php

namespace App\AdminModule\Presenters;


use App\Forms\FormFactory;
use App\Forms\MesasFormFactory;
use App\Model\Database\Entities\Mesa;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IComponent;
use Nette\Database\Table\ActiveRow;

class MesasPresenter extends BaseAdminPresenter
{

    public function renderDefault(): void
    {
        $this->template->mesas = $this->getMesasModel()->findAll();
    }


    public function createComponentMasMesasForm()
    {

        $form = (new FormFactory())->create();

        $form->addText('nombre', 'Nombre de la mesa')
            ->setRequired();

        $form->addSubmit('send', 'Añadir')
            ->setHtmlAttribute("class", 'btn btn-success');

        $form->onSuccess[] = [$this, 'onSuccessMasMesas'];//convención con la variable onSuccess y el nombre del formulario

        return $form;

    }


    public function onSuccessMasMesas(Form $form, \stdClass $values): void
    {

        $mesa = new Mesa();
        $mesa->nombre = $values->nombre;


        try {
            $mesaNueva = $this->getMesasModel()->newMesa($mesa);
            $this->flashMessage('La mesa ha sido añadido a la base de datos', 'success');
        } catch (\Exception $e) {
            $this->flashMessage($e->getMessage(), 'danger');
        }

        $this->redirect('this');

    }

    public function actionEditar($id)
    {
        $this->template->item = $this->getMesasModel()->findById($id);
    }

    public function createComponentEditarMesaForm()
    {
        $mesa = $this->template->item;
        $form = (new MesasFormFactory())->createEdit($mesa->toArray());

        $form->onSuccess[] = [$this, 'onSuccessEditarMesa'];//convención con la variable onSuccess y el nombre del formulario

        return $form;
    }

    public function onSuccessEditarMesa(Form $form, \stdClass $values)
    {

        try {
            $mesa = $this->template->item;
            $mesa->update((array)$values);
            $this->flashMessage("Mesa editada correctamente", "success");
        } catch (\Exception $e) {
            $this->flashMessage("Error al editar", 'danger');
        }

        $this->redirect("this");
    }

    public function actionBorrar($id)
    {
        try {
            if (!$plato = $this->getMesasModel()->findById($id)) {
                throw new \Exception("mesa no encontrada");
            };
            $plato->delete();
            $this->flashMessage("Mesa eliminado", "success");
        } catch (\Exception $e) {
            $this->flashMessage("Error al eliminar la mesa, ¿Es una id válida?: " . $e->getMessage(), 'danger');
        }

        $this->redirect('default');
    }

}

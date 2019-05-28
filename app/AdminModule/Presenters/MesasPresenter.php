<?php

namespace App\AdminModule\Presenters;


use App\Forms\FormFactory;
use App\Forms\MesasFormFactory;
use App\Model\Orm\Mesa;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IComponent;
use Nette\Database\Table\ActiveRow;

class MesasPresenter extends BaseAdminPresenter
{
    /** @var $mesaEditada Mesa */
    private $mesaEditada;

    public function renderDefault(): void
    {
        $this->template->mesas = $this->orm->mesas->findAll();
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
            $mesaNueva = $this->orm->mesas->persistAndFlush($mesa);
            $this->flashMessage('La mesa ha sido añadido a la base de datos', 'success');
        } catch (\Exception $e) {
            $this->flashMessage($e->getMessage(), 'danger');
        }

        $this->redirect('this');

    }

    public function actionEditar($id)
    {
        $mesa = $this->orm->mesas->getById($id);
        $this->mesaEditada = $mesa;

        $this->template->item = $this->orm->mesas->findById($id);
    }

    public function createComponentEditarMesaForm()
    {

        $form = (new MesasFormFactory())->createEdit($this->mesaEditada);

        $form->onSuccess[] = [$this, 'onSuccessEditarMesa'];//convención con la variable onSuccess y el nombre del formulario

        return $form;
    }

    public function onSuccessEditarMesa(Form $form, \stdClass $values)
    {

        try {
            $mesa = $this->mesaEditada;
            $mesa->nombre = $values->nombre;

            $this->orm->mesas->persistAndFlush($mesa);
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
            $this->orm->mesas->remove($id);
            $this->flashMessage("Mesa eliminado", "success");
        } catch (\Exception $e) {
            $this->flashMessage("Error al eliminar la mesa, ¿Es una id válida?: " . $e->getMessage(), 'danger');
        }

        $this->redirect('default');
    }

}

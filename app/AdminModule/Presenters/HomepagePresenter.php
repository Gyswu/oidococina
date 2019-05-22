<?php

declare(strict_types=1);

namespace App\AdminModule\Presenters;

use Nette;
use Nette\Application\UI\Form;


final class HomepagePresenter extends BaseAdminPresenter
{


    public function renderDefault(): void
    {

    }

    public function renderPedidos(): void
    {
        $this->template->bebidas = $this->database->table('bebidas')
            ->order('b_id ASC')
            ->limit(10);
    }

    public function createComponentBebidasForm()
    {
        $form = new Form;
        $form->addText('nombre', 'Nombre de la bebida:')
            ->setRequired();

        $form->addinteger('precio', 'Precio: ')
            ->setRequired()
            ->addRule($form::RANGE, 'El precio ha de ser mayor de 0', [0, 10000]);

        $form->addCheckbox('azucar', 'Tiene azucar? ');
        $form->addCheckbox('alcohol', 'Tiene alcohol? ');

        $form->addSubmit('send', 'Add');

        $form->onSuccess[] = [$this, 'commentFormBebidasEnviado'];
        return $form;


    }

    public function commentFormBebidasEnviado(Form $form, \stdClass $values): void
    {

        $this->database->table('bebidas')->insert([
            'nombre' => $values->nombre,
            'precio' => $values->precio,
            'azucar' => $values->azucar,
            'alcohol' => $values->alcohol,
        ]);

        $this->flashMessage('La bebida ya ha sido añadida a la base de datos', 'success');
        $this->redirect('this');
    }
}

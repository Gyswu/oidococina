<?php

declare(strict_types=1);

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;


final class PlatosFormFactory
{
    use Nette\SmartObject;

    public function create(): Form
    {
        $form = (new FormFactory())->create();

        $form->addText('nombre', 'Nombre del plato')
            ->setRequired();
        $form->addText('precio', 'Precio del plato')
            ->setRequired()
            ->addRule(Form::FLOAT, 'Debe ser un numero')
            ->setHtmlAttribute("step", '.01');

        $form->addSubmit('send', 'Guardar')
            ->setHtmlAttribute("class", 'btn btn-success');

        return $form;
    }

    public function createEdit(array $plato){

        $form = $this->create();
        $form->setDefaults($plato);

        return $form;

    }
}

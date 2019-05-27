<?php

declare(strict_types=1);

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;


final class ProductosFormFactory
{
    use Nette\SmartObject;

    public function create(): Form
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

      $form->addSubmit('send', 'Editar')
          ->setHtmlAttribute("class", 'btn btn-success');

        return $form;
    }

    public function createEdit(array $producto){

        $form = $this->create();
        $form->setDefaults($producto);

        return $form;

    }
}

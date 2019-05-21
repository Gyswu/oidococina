<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{

  private $database;

  public function __construct(Nette\Database\Context $database){

      $this->database = $database;
  }
  public function renderDefault(): void
  {


    $this->template->bebidas = $this->database->table('bebidas')
      ->order('b_id ASC')
      ->limit(10);

      $this->template->platos = $this->database->table('platos')
          ->order('p_id ASC')
          ->limit(10);

      $this->template->complementos = $this->database->table('complementos')
            ->order('c_id ASC')
            ->limit(10);
  }
  public function renderpedidos(): void
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

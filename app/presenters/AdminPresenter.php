<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;


final class AdminPresenter extends BasePresenter
{

  private $database;

  public function __construct(Nette\Database\Context $database){

      $this->database = $database;
  }

  public function renderMesas(): void
  {
    $this->template->mesas = $this->database->table('mesas')
      ->order('num_mesa ASC');
  }

  public function createComponentMasMesasForm(){

    $form = new Form;

    $form->addinteger('num_mesa', 'Numero de mesa: ')
      ->setRequired();
    $form->addSubmit('send', 'Añadir');

    $form->onSuccess[] = [$this, 'commentFormMasMesas'];
    return $form;

  }

  public function commentFormMasMesas(Form $form, \stdClass $values): void
  {

    $this->database->table('mesas')->insert([
      'num_mesa' => $values->num_mesa
    ]);

    $this->flashMessage('La mesa ha sido añadida a la base de datos', 'success');
    $this->redirect('this');

  }
  public function createComponentMenosMesasForm(){

    $form = new Form;

    $form->addinteger('num_mesa', 'Numero de mesa: ')
      ->setRequired();
    $form->addSubmit('send', 'Eliminar');

    $form->onSuccess[] = [$this, 'commentFormMenosMesas'];
    return $form;

  }
  public function commentFormMenosMesas(Form $form, \stdClass $values): void
  {

    $this->database->table('mesas')->where('num_mesa', $values->num_mesa)->delete();

    $this->flashMessage('La mesa ha sido eliminada a la base de datos', 'success');
    $this->redirect('this');

  }
}

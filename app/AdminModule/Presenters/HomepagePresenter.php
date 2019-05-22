<?php


declare(strict_types=1);

namespace App\AdminModule\Presenters;

use Nette;
use Nette\Application\UI\Form;


final class HomepagePresenter extends BaseAdminPresenter
{


  //APARTADO DE MESAS
  public function renderMesas(): void
  {
    $this->template->mesas = $this->database->table('Mesas')
      ->order('id ASC');
  }

  public function createComponentMasMesasForm(){

    $form = new Form;

    $form->addText('id', 'ID de la mesa: ')
      ->addRule(Form::INTEGER, 'Debe ser un numero entero.');
    $form->addText('nombre', 'Nombre de la mesa')
      ->setRequired();
    $form->addSubmit('send', 'Añadir');

    $form->onSuccess[] = [$this, 'commentFormMasMesas'];
    return $form;

  }

  public function commentFormMasMesas(Form $form, \stdClass $values): void
  {

    $this->database->table('Mesas')->insert([
      'id' => $values->id,
      'nombre' => $values->nombre
    ]);

    $this->flashMessage('La mesa ha sido añadida a la base de datos', 'success');
    $this->redirect('this');

  }
  public function createComponentMenosMesasForm(){

    $form = new Form;

    $form->addinteger('id', 'ID de mesa: ')
      ->setRequired();
    $form->addSubmit('send', 'Eliminar');

    $form->onSuccess[] = [$this, 'commentFormMenosMesas'];
    return $form;

  }
  public function commentFormMenosMesas(Form $form, \stdClass $values): void
  {

    $this->database->table('Mesas')->where('id', $values->id)->delete();

    $this->flashMessage('La mesa ha sido eliminada a la base de datos', 'success');
    $this->redirect('this');

  }

  // APARTADO DE PLATOS
  public function renderPlatos() :void{

      $this->template->platos = $this->database->table('Platos')
        ->order('id ASC');

  }
  public function createComponentMasPlatosForm(){

    $form = new Form;

    $form->addText('id', 'IENTIFICADOR del plato ')
      ->addRule(Form::INTEGER, 'Debe ser un numero entero.');
    $form->addText('nombre', 'Nombre del plato')
      ->setRequired();
    $form->addText('precio', 'Precio del plato')
      ->setRequired()
      ->addRule(Form::FLOAT, 'Debe ser un numero');
    $form->addSubmit('send', 'Añadir');

    $form->onSuccess[] = [$this, 'commentFormMasPlatos'];
    return $form;

  }
  public function commentFormMasPlatos(Form $form, \stdClass $values): void
  {

    $this->database->table('Platos')->insert([
      'id' => $values->id,
      'nombre' => $values->nombre,
      'precio' => $values->precio
    ]);

    $this->flashMessage('El plato ha sido añadido a la base de datos', 'success');
    $this->redirect('this');

  }

  public function createComponentMenosPlatosForm(){

    $form = new Form;

    $form->addText('id', 'IDENTIFICADOR del plato a eliminar')
    ->addRule(Form::INTEGER, 'Debe ser un numero entero')
    ->setRequired();

    $form->onSuccess[] = [$this, 'commentFormMenosPlatos'];
    return $form;
  }

  public function commentFormMenosPlatos(Form $form, \stdClass $values): void
  {
    $this->database->table('Platos')->where('id', $values->id)->delete();
    $this->flashMessage('El plato ha sido eliminado de la base de datos', 'success');
    $this->redirect('this');
  }
}

<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;


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

      $this->template->pedidos_activos = $this->database->table('pedidos_activos')
          ->order('id_pedido ASC')
          ->limit(10);

      $this->template->complementos = $this->database->table('complementos')
            ->order('c_id ASC')
            ->limit(10);
  }
  public function renderpedidos(): void
  {
  $this->template->bebidax = $this->database->table('bebidas')
    ->order('b_id ASC')
    ->limit(10);


  }

}

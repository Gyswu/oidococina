<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;


final class PedidosPresenter extends Nette\Application\UI\Presenter
{
  private $database;

  public function __construct(Nette\Database\Context $database){

      $this->database = $database;
  }

  public function renderPedidos(): void{
    $this->template->bebidas = $this->database->table('bebidas')
      ->order('b_id ASC')
      ->limit(10);
  }

}

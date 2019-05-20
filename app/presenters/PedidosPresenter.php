<?php


namespace App\Presenters;

use Nette;


class PedidosPresenter extends Nette\Application\UI\Presenter
{

  private $database;

  public function __construct(Nette\Database\Context $database){

      $this->database = $database;
  }

  public function renderPedir(int $b_id): void
  {
      $bebida = $this->database->table('bebidas')->get($b_id);
      if (!$bebida) {
          $this->error('Post not found');
      }

      $this->template->bebi = $bebida;
  }
}

<?php


namespace App\Presenters;

use Nette;


class PedidosPresenter extends Nette\Application\UI\Presenter
{


  public function renderPedir(int $b_id): void
  {
      $bebida = $this->database->table('bebidas')->get($b_id);
      if (!$bebida) {
          $this->error('Post not found');
      }

      $this->template->bebi = $bebida;
  }
}

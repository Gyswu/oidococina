<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;


final class PedidosPresenter extends Nette\Application\UI\Presenter
{

  public function renderPedidos(int $bebida_b_id): void
  {
      $bebida = $this->database->table('bebidas')->get($bebida_b_id);
      if (!$bebida) {
          $this->error('Post not found');
      }

      $this->template->bebida = $bebida;
  }
}

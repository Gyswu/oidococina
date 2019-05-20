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
  public function renderbebidas(): void
  {

      $this->template->bebidas = $this->database->table('bebidas')
        ->order('b_id ASC')
        ->limit(10);
  }
  public function renderplatos(): void
  {

      $this->template->platos = $this->database->table('platos')
        ->order('p_id ASC')
        ->limit(10);
  }

}

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

  public function renderpedidos(): void
  {
    $this->template->bebidas = $this->database->table('')
      ->order('b_id ASC');
  }
}

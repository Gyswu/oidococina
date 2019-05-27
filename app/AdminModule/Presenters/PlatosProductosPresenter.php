<?php

namespace App\AdminModule\Presenters;


use App\Forms\FormFactory;
use App\Forms\ProductosFormFactory;
use App\Model\Database\Entities\PlatoProducto;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IComponent;
use Nette\Database\Table\ActiveRow;

class platosProductosPresenter extends BaseAdminPresenter
{
  public function renderDefault(): void
  {
      $this->template->platosproductos = $this->getPlatosProductosModel()->findAll();
  }

}

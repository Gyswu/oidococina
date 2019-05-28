<?php
declare(strict_types=1);

namespace App\Presenters;

final class HomepagePresenter extends BasePresenter {
    
    public function renderDefault() {
        
        
        $ingrediente = $this->orm->ingredientes->getById(1);
        
        $producto = $this->orm->productos->getById(1);
        d($producto);
        
        dd($ingrediente->producto);
//        foreach ($this->orm->platos->getById(1)->productos as $producto) {
//            foreach ($producto->platos as $plato) {
//                $plato->nombre = 'Judías escozías';
//                $this->orm->persistAndFlush($plato);
//            }
//        }
    }





//  private $database;
//  public function __construct(Nette\Database\Context $database){
//
//      $this->database = $database;
//  }
//  public function renderPedidos(): void
//  {
//    $this->template->bebidas = $this->database->table('')
//      ->order('b_id ASC');
//  }
}

<?php


namespace App\Model\Database;
use Nette\Application\UI\Form;


class PlatosModel extends BaseModel
{

    public function getAll() {


        $all=$this->getDb()->table('Platos')
        ->order('id ASC')
        ->fetchAll();
        return $all;
    }

    public function newPlato(Form $form) :void
    {
      $values = $form->getValues();

      $this->getDb()->table('Platos')->insert([
        'nombre' => $values->nombre,
        'precio' => $values->precio
      ]);


    }

}

<?php


namespace App\Model\Database;
use Nette\Application\UI\Form;


class PlatosModel extends BaseModel
{
    /*Estas son las columnas de la base de datos, si las pones aquí luego el IDE te ayuda*/
    public $name;
    public $precio;

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
    
    public function saveNew(){
        //haciendo return puedes acceder al last id y demás hostias nada mas insertarlo
        return $this->getDb()->query('INSERT INTO Platos ?', [ // here can be omitted question mark
            'nombre' => $this->nombre,
            'precio' => $this->precio,
        ]);
    }

}

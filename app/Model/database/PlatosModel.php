<?php


namespace App\Model\Database;

use App\Model\Database\Entities\Plato;
use Nette\Application\UI\Form;


class PlatosModel extends BaseModel
{

    /**
     * @return Plato
     */
    public function getEntity()
    {
        return $this->entity;
    }










    public function getAll()
    {
        $all = $this->getDb()->table('Platos')
            ->order('id ASC')
            ->fetchAll();
        return $all;
    }

    public function newPlato(Plato $plato)
    {
        return $this->getDb()->table($this->getTableName())->insert((array)$plato);
    }

    public function saveNew()
    {
        //haciendo return puedes acceder al last id y demás hostias nada mas insertarlo
        return $this->getDb()->query('INSERT INTO Platos ?', [ // here can be omitted question mark
            'nombre' => $this->nombre,
            'precio' => $this->precio,
        ]);
    }

}

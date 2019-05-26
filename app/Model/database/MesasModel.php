<?php


namespace App\Model\Database;


use App\Model\Database\Entities\Mesa;

class MesasModel extends BaseModel
{

    /**
     * @return Mesa
     */
    public function getEntity()
    {
        return $this->entity;
    }

    public function getAll() {


        $all=$this->getDb()->table('Mesas')
        ->order('id ASC')
        ->fetchAll();
        return $all;
    }
    public function newMesa(Mesa $mesa)
    {
        return $this->getDb()->table($this->getTableName())->insert((array)$mesa);
    }

    public function saveNew()
    {
        //haciendo return puedes acceder al last id y demás hostias nada mas insertarlo
        return $this->getDb()->query('INSERT INTO Mesas ?', [ // here can be omitted question mark
            'nombre' => $this->nombre,
        ]);
    }

}

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

}

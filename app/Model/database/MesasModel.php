<?php


namespace App\Model\Database;


class MesasModel extends BaseModel
{

    public function getAll() {


        $all=$this->getDb()->table('Mesas')
        ->order('id ASC')
        ->fetchAll();
        return $all;
    }

}

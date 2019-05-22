<?php


namespace App\Model\Database;


class PlatosModel extends BaseModel
{

    public function getAll() {


        $all=$this->getDb()->table('Platos')
        ->order('id ASC')
        ->fetchAll();
        return $all;
    }

}

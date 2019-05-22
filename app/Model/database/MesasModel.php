<?php


namespace App\Model\Database;


class MesasModel extends BaseModel
{

    public function getAll() {


        dd($this->getDb()->table($table));

        return 'all';
    }

}
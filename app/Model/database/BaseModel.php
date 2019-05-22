<?php

namespace App\Model\Database;

use Nette;

class BaseModel
{

    protected $database;

    public function __construct(Nette\Database\Context $database){

        $this->database = $database;
    }

    public function getDb(){
        return $this->database;
    }
}
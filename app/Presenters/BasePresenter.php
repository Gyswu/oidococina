<?php
declare(strict_types=1);

namespace App\Presenters;

use App\Model\Orm;
use Nette;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter {
    
    /** @var Orm\Orm @inject */
    public $orm;

//    protected $database;
//    public function __construct(Nette\Database\Context $database){
//        $this->database = $database;
//    }
}

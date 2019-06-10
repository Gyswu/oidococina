<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

function da(...$s){
    dump(...$s);
}
function d($arr, $depth = 5, $live = false){
//    foreach ($arr as $a){
    \Tracy\Dumper::dump($arr, ["depth"=> $depth, "live" => $live]);
//    }
}
function dd($arr, $depth = 5, $live = false){
    d($arr, $depth, $live);
    die();
}

define('_APPDIR', __DIR__.'/../app');


App\Booting::boot()
	->createContainer()
	->getByType(Nette\Application\Application::class)
	->run();

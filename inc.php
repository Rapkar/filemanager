<?php


//define

define('FREESPACEDISK',disk_free_space("/"));
define('BASEDIR',__DIR__);
define('APPDIR',__DIR__.'\App');
define('CLASSDIR',__DIR__.'\App\controller\classes');
define('VIEWSDIR',__DIR__.'\views');
define('PUBLICDIR',__DIR__.'\public');


//loader
require __DIR__ . '\App\facade.php';
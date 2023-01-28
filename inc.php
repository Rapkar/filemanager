<?php


//define

define('FREESPACEDISK',disk_free_space("/"));
define('BASEDIR',__DIR__);
define('APPDIR',__DIR__.'/App');
define('CLASSDIR',__DIR__.'/App/controller/classes');
define('VIEWSDIR',__DIR__.'/views');
define('PUBLICDIR',__DIR__.'/public');


//loader
require __DIR__ . '/App/facade.php';
if(isset($_POST['data'] )&& $_POST['data'] !=='' ){
    if(!empty($FileFinder->findeFileWithName($_POST['data']))){
$res=$FileFinder->findeFileWithName($_POST['data']);
$out='
     <tr>
            <td>
                <div class="d-flex align-items-center">
                    <div><i class=" bx bxs-file-text me-2 font-24 text-danger"></i>
                    </div>
                    <div class="font-weight-bold text-danger">'.$res[0]['name'].'</div>
                </div>
            </td>
            <td>'.$res[0]['size'].'</td>
            <td>'.$res[0]['date'].'</td>
            <td><a href="/'.$res[0]['dir'].'"><i class="fa fa-ellipsis-h  font-24"></i></a>
            </td>
        </tr>
';
echo $out;
    }else{
      echo 'not found';;
    }
 //    var_dump($_POST['data']);
 }
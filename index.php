<?php

// include files
require __DIR__ . '/inc.php';
// include files

    $list=getListFiles(['.jpg','.png']);
    $it = new RecursiveIteratorIterator(new RecursiveArrayIterator( $list));
foreach( $list as $key=>$v) {
  $list[]= $v;
}
    var_dump( $list);
// var_dump(getListFiles(['.jpg','.png']));
 // home page
include VIEWSDIR.'/home.php';
// home page


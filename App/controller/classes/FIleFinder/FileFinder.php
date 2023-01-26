<?php

class FileFinder
{
    private $dir;
    private $alldirctory;


    public function __construct($dir = PUBLICDIR)
    {
        $this->dir = $dir;
        $this->alldirctory = $this->FindAllDirctory($dir);
    }

    
    public function FindAllDirctory($dir)
    {
        if(!isset($dir)){
            $dir = $this->dir;
        }
     
        $result = [];
        $cdir = scandir($dir);

        foreach ($cdir as $key => $value) {

            if (!in_array($value, array(".", ".."))) {

                if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {

                    $result[$value] = $this->FindAllDirctory($dir . DIRECTORY_SEPARATOR . $value);
                } else {
                    $result[] = $value;
                }
            }
        }

        return  $result;
    }


    public function mergeList($results, $type)
    {
        if (is_array($results)) {

            foreach ($results as $result) {

                $list[] = $this->mergeList($result, $type);
            }
        } else {
            $list[] = $results;
        }
        return $list;
    }
    public  function getListFiles(array $type, $count = false)
    {

        $results = [];
        $list = [];
        $tm = [];
        foreach ($this->alldirctory as $key => $item) {
            if (is_array($item) && !is_null($item)) {

                $results[] = $item;
            } else if (!is_null($item)) {
                $results[] = [$item];
            }
        }

        $list = $this->mergeList($results, $type);
        foreach (array_flatten($list) as $item) {
            if (!is_null($item) && in_array(strrchr($item, '.'), $type)) {
                $tm[] =  $item;
            }
        }

        if ($count === true && !empty($list)) {
            return count($tm);
        } else if ($count === false  && !empty($list)) {
            return $tm;
        } else {
            return 0;
        }
    }
    public function getSizeOfFiles($list,$type){
        if(!isset($dir)){
            $list = $this->getListFiles($type);
        }
        foreach($list as $item){
           echo filesize($item);
        }
    }
}

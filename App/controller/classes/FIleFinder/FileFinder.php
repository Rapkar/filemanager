<?php

class FileFinder
{   
    private $dir;
    private $alldirctory;

    public function __construct($dir=PUBLICDIR)
    {
     $this->dir=$dir;
    }
    public function test()
    {
        return $this->dir;
    }
    public function FindAllDirctory()
    {

        $result = [];
        $cdir = scandir(PUBLICDIR);

        foreach ($cdir as $key => $value) {

            if (!in_array($value, array(".", ".."))) {

                if (is_dir(PUBLICDIR. DIRECTORY_SEPARATOR . $value)) {

                    $result[$value] = $this->FindAllDirctory($this->dir . DIRECTORY_SEPARATOR . $value);
                } else {
                    $result[] = $value;
                }
            }
        }
        $this->alldirctory=$result;
       return $result;
   
    }

    public function getListFiles(array $type, $count = false)
    {

        $results = [];
        $list = [];
        $tm = [];
        $list = $this->arrayFlatten($this->alldirctory);
        // foreach ($allfiles as $key => $item) {


        //     if (is_array($item) && !is_null($item)) {

        //         $results[] = $item;
        //     } else if (!is_null($item)) {
        //         $results[] = [$item];
        //     }
        // }

        // $list = $this->mergeList($results, $type);

        foreach ($list as $item) {
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

    public function arrayFlatten($array)
    {
        if (!is_array($array)) {
            return FALSE;
        }
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, $this->arrayFlatten($value));
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }
}

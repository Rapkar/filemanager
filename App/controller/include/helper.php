<?php

$SpaceDetail = new SpaceDetail;
function getSize($size, array $options = null)
{

	$o = [
		'binary' => false,
		'decimalPlaces' => 2,
		'decimalSeparator' => '.',
		'thausandsSeparator' => '',
		'maxThreshold' => false, // or thresholds key
		'sufix' => [
			'thresholds' => ['', 'K', 'M', 'G', 'T', 'P', 'E', 'Z', 'Y'],
			'decimal' => ' {threshold}B',
			'binary' => ' {threshold}iB'
		]
	];

	if ($options !== null)
		$o = array_replace_recursive($o, $options);

	$count = count($o['sufix']['thresholds']);
	$pow = $o['binary'] ? 1024 : 1000;

	for ($i = 0; $i < $count; $i++)

		if (($size < pow($pow, $i + 1)) ||
			($i === $o['maxThreshold']) ||
			($i === ($count - 1))
		)
			return

				number_format(
					$size / pow($pow, $i),
					$o['decimalPlaces'],
					$o['decimalSeparator'],
					$o['thausandsSeparator']
				) .

				str_replace(
					'{threshold}',
					$o['sufix']['thresholds'][$i],
					$o['sufix'][$o['binary'] ? 'binary' : 'decimal']
				);
}

function getFilesCount()
{
	return count(array_slice(scandir(PUBLICDIR), 2));
}

function FindAllDirctory($dir)
{
	$result = [];
	$cdir = scandir($dir);

	foreach ($cdir as $key => $value) {

		if (!in_array($value, array(".", ".."))) {

			if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {

				$result[$value] = FindAllDirctory($dir . DIRECTORY_SEPARATOR . $value);
			} else {
				$result[] = $value;
			}
		}
	}

	return $result;
}

function getListFiles(array $type, $count = false)
{

	$results = [];
	$list = [];
	$tm=[];
	$allfiles = FindAllDirctory(PUBLICDIR);
	$list=array_flatten($allfiles);
	foreach ($allfiles as $key => $item) {


		if (is_array($item) && !is_null($item)) {

			$results[] = $item;
		} else if (!is_null($item)) {
			$results[] = [$item];
		}
	}

	$list = mergeList($results, $type);
	
	 foreach (array_flatten($list) as $item){
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


function mergeList($results, $type)
{
	

	if (is_array($results)) {

		foreach ($results as $result) {
			
			$list[] = mergeList($result, $type);
		}
		// if (!is_null($result) && in_array(strrchr($result[0], '.'), $type)) {
		// $list[] = $result;
		// }
	}else{
		$list[]=$results;
	}
	// var_dump($list);
	return $list;
}

    function array_flatten($array) { 
      if (!is_array($array)) { 
        return FALSE; 
      } 
      $result = array(); 
      foreach ($array as $key => $value) { 
        if (is_array($value)) { 
          $result = array_merge($result, array_flatten($value)); 
        } 
        else { 
          $result[$key] = $value; 
        } 
      } 
      return $result; 
    } 

<?php

/**
 * lcs算法 对比字符串的不同
 * @param  [type] $oldStr [description]
 * @param  [type] $newStr [description]
 * @return [type]         [description]
 */
function lcs($oldStr,$newStr)
{

	$diffVal = $diffMark = array();

	$matrix = array();

	$oldStr = mb_str_split($oldStr);
	$newStr = mb_str_split($newStr);

	$oldCount = count($oldStr);
	$newCount = count($newStr);

	for($i = -1;$i < $newCount;$i++){
		$matrix[-1][$i] = 0;
	} 

	for($i = -1;$i < $oldCount;$i++){
		$matrix[$i][-1] = 0;
	}

	for($i = 0;$i < $oldCount;$i++){
		for($j = 0;$j < $newCount;$j++){
			if($oldStr[$i] == $newStr[$j]){

				$ad = $matrix[$i - 1][$j - 1];
				$matrix[$i][$j] = $ad + 1;
			}else{
				$a1 = $matrix[$i - 1][$j];
				$a2 = $matrix[$i][$j - 1];
				$matrix[$i][$j] = max($a1,$a2);
			}
		}
	}


	$i = $oldCount - 1;
	$j = $newCount - 1;

	while(($i > -1) || ($j > -1)){

		if($j > -1){
			if($matrix[$i][$j-1] == $matrix[$i][$j]){
				$diffVal[] = $newStr[$j];
				$diffMark[] = 1;
				$j--;
				continue;
			}
		}


		if($i > -1){
			if($matrix[$i - 1][$j] == $matrix[$i][$j]){
				$diffVal[] = $oldStr[$i];
				$diffMark[] = -1;
				$i--;
				continue;
			}
		}

		$diffVal[] = $oldStr[$i];
		$diffMark[] = 0;
		$i--;
		$j--;
		
	}

	$diffVal = array_reverse($diffVal);
	$diffMark = array_reverse($diffMark);

	return array("values"=>$diffVal,"mark"=>$diffMark);
}



/**
 * 将字符串打散为数组
 * @param  [type] $str [description]
 * @return [type]      [description]
 */
function mb_str_split($str)
{
	return preg_split('/(?<!^)(?!$)/u', $str);
}


$oldStr = "这是lcs算法，用来对比字符串的不同";
$newStr = "lcs算法，对比两个字符串的不同处";

$diff = lcs($oldStr,$newStr);

echo "<pre>";
var_dump($diff);
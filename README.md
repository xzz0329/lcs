# lcs
php对比两个字符串的不同

$oldStr = "这是lcs算法，用来对比字符串的不同";
$newStr = "lcs算法，对比两个字符串的不同处";

$diff = lcs($oldStr,$newStr);

var_dump($diff);

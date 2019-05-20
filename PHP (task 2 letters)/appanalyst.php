<?php
header('Content-Type: text/html; charset=utf-8');
$dir = opendir("./");
$plugins = array();
while($any_file = readdir($dir)){
    if (is_file($any_file)){
        if(strpos($any_file, '.plugin.php')!==FALSE){
			include("./".$any_file);
			$plugins[]=substr($any_file,0,strpos($any_file, '.plugin.php'));
        }
    }
}
closedir($dir);

$input = "./input.txt";
$text = file_get_contents($input);
print "<p>Анализ файла ".basename($input);
print "</p>";
foreach ($plugins as $p){
    $info_func = $p.'_info';
    $calc_func = $p.'_analysis';
    if (!function_exists($info_func) || !function_exists($calc_func)){
        print "<p>Плагин $p содержит ошибку</p>";
    }
	else{
        print "<p>";
        print call_user_func($info_func)." - ";
        print call_user_func($calc_func, $text);
        print "</p>";
    }
}
?>
<?php

header('Content-type: text/html; charset=utf-8');

$a = readline('a = ');

print $a;

// $file = fopen('russian.txt', 'r');
// $content = fread($file, filesize('russian.txt'));
$tmp = file_get_contents('russian.txt');
$enc = mb_detect_encoding($tmp);
print $enc;
print $tmp;

// if ($file) {
//     $i = 0;
//     while (($line = fgets($file)) !== false) {
//         // process the line read.
//         print $line;
//         $i++;
//         if($i > 9) {
//             // break;
//         }
//     }

//     fclose($file);
// }

// print $content;

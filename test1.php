<?php
$x = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];
//
//for($i = 0; $i < count($x); $i++ ) {
//    var_dump($i);
//    unset($x[$i]);
//}


function biteTailRecursive($x) {
    if(count($x) > 0) {
        return  [array_pop($x) => biteTailRecursive($x)];
    }
    return null;
}


print_r(biteTailRecursive($x));
?>
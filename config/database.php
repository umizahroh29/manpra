<?php

function connect()
{
//    $connect = mysqli_connect('remotemysql.com', 'wJNuAs5aSV', 'zjDqw2wt7D', 'wJNuAs5aSV');
    $connect = mysqli_connect('localhost', 'root', '', 'manpra');

    if ($connect) {
        return $connect;
    } else {
        die('Connection Failed');
    }
}

?>
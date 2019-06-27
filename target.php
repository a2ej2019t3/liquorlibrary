<?php
    include ($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'liquorlibrary'.DIRECTORY_SEPARATOR.'rootpath.php');
    // var_dump(pathinfo($_SERVER['SCRIPT_FILENAME']));
    // var_dump(pathinfo($_SERVER['DOCUMENT_ROOT']));

        $rf = dirname(__DIR__, 1);
    // function search_file($rootfolder){
        // $rootfolder = dirname(__DIR__, 1);
        // print_r($rootfolder);
        // $files = scandir($rootfolder);
        
    //     foreach($files as $key => $value){

    //         $path = realpath($rootfolder.DIRECTORY_SEPARATOR.$value);
    //         print_r($path.'<br>');
    //         // print_r($value.'<br>');
    //         // var_dump(is_dir($path));
    //         // if (!is_dir($path) && $file_to_search == $value) {
    //         //     echo "file found<br>";
    //         //     echo $path;
    //         //     break;
    //         // } else if (is_dir($path) && $value != '.' && $value != '..') {
                
    //         //     search_file($path, $file_to_search);
        
    //         // }
    //     }
    // }
    // search_file(dirname(__DIR__, 1));

    // .DIRECTORY_SEPARATOR.'signInUp'.DIRECTORY_SEPARATOR
<?php

    require "./inc/pIRCLoader.class.php";

    pIRCLoader::init();
    
    try{
        $socket = new pIRCSocket("kolacek.it", 80);
    }
    catch(pIRCException $e){
        echo $e->getMessage();
    }

    echo "Hello";

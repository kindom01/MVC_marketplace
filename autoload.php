<?php
    function controller_autoload($class){
        require_once "controllers/".$class.".php";
    }

    spl_autoload_register('controller_autoload');
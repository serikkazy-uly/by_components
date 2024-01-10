<?php

class Config{

    public static function get($path = null){
        
        if ($path){
            $config = $GLOBALS['config'];
            $path = explode('.' , $path);
    // var_dump($path);die;
            // echo $config[$path[0]] [$path[1]] [$path[2 ]] [$path[3]] [$path[4]];die;

            foreach($path as $item){
                if (isset($config[$item])) {
                    $config = $config[$item];
                }
            }
            return $config;
        }
        return false;
    }
}
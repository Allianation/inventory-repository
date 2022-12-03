<?php

/**
 * Description of autoload
 *
 * @author Sergio Damián Alliana
 */
class autoload {
    
    static public function cargar_clase($clase) {
        
        $arrayClase = array();
        $base = __DIR__.DIRECTORY_SEPARATOR;
        $arrayClase['database'] = $base.'database.php';
        $arrayClase['category'] = $base.'category.php';
        $arrayClase['product'] = $base.'product.php';
       
        if(isset($arrayClase[$clase])) {
            if(file_exists($arrayClase[$clase])) {
                include $arrayClase[$clase];
            } else {
                throw new Exception ("Archivo de clase no encontrada [{$arrayClase[$clase]}]");
            }
        }
    }
    
}

spl_autoload_register('autoload::cargar_clase');
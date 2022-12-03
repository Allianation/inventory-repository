<?php

/**
 * Description of database
 *
 * @author Sergio Damián Alliana
 */
class database {
    
    private $gbd;
    
    function __construct($driver, $host, $port, $dbname, $user, $pass) {
        $conection = $driver.":host=".$host.";port=".$port.";dbname=".$dbname;
        $this->gbd = new PDO($conection, $user, $pass);
        
        if ($this->gbd) {
            //echo "Connected to the database successfully!";
            //echo "<br>";
        }
    
        if (!$this->gbd){
            throw new Exception("No se ha podido realizar la conexión");
        }
    }  
    
    function select($tabla, $filtros = null, $arr_prepare = null, $orden = null, $limit = null){
        $sql = "SELECT * FROM " . $tabla;
        if ($filtros != null){
            $sql .= " WHERE ".$filtros;
        }
         if ($orden != null){
            $sql .= " ORDER BY ".$orden;
        }
        if ($limit != null){
            $sql .= " LIMIT ".$limit;
        }
        
        //echo "<br>";
        //echo $sql;
        
        $resource = $this->gbd->prepare($sql);
        $resource->execute($arr_prepare);
        if ($resource){
            return $resource->fetchAll(PDO::FETCH_ASSOC);
        } else {
            throw new Exception ("No se pudo realizar la consulta de selección");
        }
    }

    function delete($tabla, $filtros = null, $arr_prepare = null){
        $sql = "DELETE FROM " . $tabla . " WHERE " . $filtros;
        
        //echo "<br>";
        //echo $sql;
        
        $resource = $this->gbd->prepare($sql);
        $resource->execute($arr_prepare);
        
        if ($resource){
            return true;
        } else {
            throw new Exception ("No se pudo realizar la eliminacion del registro");
        }
    }

    function insert($tabla, $campos, $valores, $arr_prepare = null){
        $sql = "INSERT INTO " . $tabla . "(" . $campos . ") VALUES (" . $valores . ")";
        
        //echo "<br>";
        //echo $sql;
        
        $resource = $this->gbd->prepare($sql);
        $resource->execute($arr_prepare);
        
        if ($resource){
            return $this->gbd->lastInsertId();
        } else {
            echo '<pre>';
            print_r($resource->errorInfo());
            echo '</pre>';
            throw new Exception ("No se pudo realizar la insercion del registro");
        }
    }

    function update($tabla, $campos, $filtros, $arr_prepare = null){
        $sql = "UPDATE " . $tabla . " SET " . $campos . " WHERE " . $filtros;
        
        //echo "<br>";
        //echo $sql;
        
        $resource = $this->gbd->prepare($sql);
        $resource->execute($arr_prepare);
        
        if ($resource){
            return true;
        } else {
            throw new Exception ("No se pudo realizar la actualizacion del registro");
        }
    }
}

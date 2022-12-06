<?php

/**
 * Description of category
 *
 * @author Sergio Damián Alliana
 */
class category {
    
    protected $id_category;
    public $name_category;
    private $_exists = false;
    
    function __construct($id_category = null) {
        if($id_category != null) {
            //$db = new database("pgsql", "localhost", "5432", "inventory", "postgres", "admin");
            $db = new database("mysql", "localhost", "3306", "inventory", "root", "");
            $resp = $db->select("category", "id_category = ?", array($id_category));
 
            if(isset($resp[0]['ID_CATEGORY'])) {
                $this->id_category = $resp[0]['ID_CATEGORY'];
                $this->name_category = $resp[0]['NAME_CATEGORY'];
                $this->_exists = true;
            }
            
        }
    }
    
    public function guardar() {
        if($this->_exists) {
            return $this->actualizar();
        } else {
            return $this->insertar();
        }
    }
    
    public function eliminar() {
        //$db = new database("pgsql", "localhost", "5432", "inventory", "postgres", "admin");
        $db = new database("mysql", "localhost", "3306", "inventory", "root", "");
        return $db->delete("category", "id_category = ?", array($this->id_category));
    }
    
    public function insertar() {
        //$db = new database("pgsql", "localhost", "5432", "inventory", "postgres", "admin");
        $db = new database("mysql", "localhost", "3306", "inventory", "root", "");
        $resp = $db->insert("category", "name_category", "?", array($this->name_category));
    
        if($resp) {
            $this->id_category = $resp;
            $this->_exists = true;
            return true;
        } else  {
            return false;
        }
    }
    
    public function actualizar() {
        //$db = new database("pgsql", "localhost", "5432", "inventory", "postgres", "admin");
        $db = new database("mysql", "localhost", "3306", "inventory", "root", "");
        return $db->update("category", "name_category = ?", "id_category = ?", array($this->name_category, $this->id_category));
    }
    
    static public function listar() {
        $db = new database("mysql", "localhost", "3306", "inventory", "root", "");
        return $db->select("category");
    }
    
}
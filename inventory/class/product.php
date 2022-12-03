<?php

/**
 * Description of product
 *
 * @author Sergio Damián Alliana
 */
class product {
    
    protected $id_product;
    public $name_product;
    public $image_product;
    public $description_product;
    public $id_category;
    private $_exists = false;
    
    function __construct($id_product = null) {
        if($id_product != null) {
            //$db = new database("pgsql", "localhost", "5432", "inventory", "postgres", "admin");
            $db = new database("mysql", "localhost", "3306", "inventory", "root", "");
            $resp = $db->select("product", "id_product = ?", array($id_product));
            
            if(isset($resp[0]['$id_product'])) {
                $this->id_product = $resp[0]['$id_product'];
                $this->name_product = $resp[0]['$name_product'];
                $this->image_product = $resp[0]['$image_product'];
                $this->description_product = $resp[0]['$description_product'];
                $this->id_category = $resp[0]['$id_category'];
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
        return $db->delete("product", "id_product = ?", array($this->id_product));
    }
    
    public function insertar() {
        //$db = new database("pgsql", "localhost", "5432", "inventory", "postgres", "admin");
        $db = new database("mysql", "localhost", "3306", "inventory", "root", "");
        $resp = $db->insert("product", "name_product, image_product, description_product, id_category", "?, ?, ?, ?", 
                array($this->name_product, $this->image_product, $this->description_product, $this->id_category));
    
        if($resp) {
            $this->id_product = $resp;
            $this->_exists = true;
            return true;
        } else  {
            return false;
        }
    }
    
    public function actualizar() {
        //$db = new database("pgsql", "localhost", "5432", "inventory", "postgres", "admin");
        $db = new database("mysql", "localhost", "3306", "inventory", "root", "");
        return $db->update("product", "name_product = ?, image_product = ?, description_product = ?, id_category = ?", "id_product = ?", 
                array($this->name_product, $this->image_product, $this->description_product, $this->id_category, $this->id_product));
    }
    
    static public function listar() {
        $db = new database("mysql", "localhost", "3306", "inventory", "root", "");
        return $db->select("product");
    }
    
}
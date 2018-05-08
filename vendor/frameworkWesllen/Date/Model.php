<?php
namespace FrameworkWesllen\Date;
use FrameworkWesllen\Date\conexao;
use PDO;

abstract class Model {
    private $con;
    protected $tabela;
    public function __construct() {
        $this->con = new conexao();
    }
    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }
    public function __get($atributo) {
        return $this->$atributo;
    }
    public function insert(array $campos_values) {
        try {
            $campos_array = array_keys($campos_values);
            $values_array = array_values($campos_values);
            $insert_campos = implode(",", $campos_array);
            $insert_values = implode("','", $values_array);
            $query = $this->con->conecta()->prepare("INSERT INTO $this->tabela ({$insert_campos}) VALUES('{$insert_values}');");
            
            if ($query->execute()) {
                return TRUE;
            } else {
                print_r($query->errorInfo());
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function insertEstrangeiro(array $campos_values) {
        try {           
            $campos_array_1 = array_keys($campos_values[1]);
            $values_array_1 = array_values($campos_values[1]);
            
            $insert_campos_1 = implode(",", $campos_array_1);
            $insert_values_1 = implode("','", $values_array_1);
           
            $query1 = $this->con->conecta()->prepare("INSERT INTO $this->tabela1 ({$insert_campos_1}) VALUES('{$insert_values_1}');");
            
             if ($query1->execute()) {                
                    $id =  $this->con->conecta()->lastInsertId();
                    
                    $campos_array_0 = array_keys($campos_values[0]);
                    $values_array_0 = array_values($campos_values[0]);
            
                    $insert_campos_0 = implode(",", $campos_array_0);
                    $insert_values_0 = implode("','", $values_array_0);
                    $query2 = $this->con->conecta()->prepare("INSERT INTO $this->tabela2 ({$insert_campos_0}, $this->chaveEstrangeira) VALUES('{$insert_values_0}','{$id}');");
                    
                        if ($query2->execute()) {
                            
                            return TRUE;
                        }else{
                            print_r($query2->errorInfo());
                        }
             
                return TRUE;
            } else {
                print_r($query->errorInfo());
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function read($campos = "*", $where = null) {
        try {
            $where_sql = empty($where) ? "" : "WHERE " . $where;
            $r = $this->con->conecta()->prepare("SELECT {$campos} FROM $this->tabela {$where_sql};");
              
            if ($r->execute()) {
                return $r->fetchAll(PDO::FETCH_ASSOC);
            } else {
                print_r($r->errorInfo());
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function readChave(array $campos_values, $campos = "*", $where = null) {
        try {
            
            $condicoes_array = array_values($campos_values);         
            $insert_values = implode("", $condicoes_array);
            
            $where_sql = empty($where) ? "" : "WHERE " . $where;
            $r = $this->con->conecta()->prepare("SELECT {$campos} FROM $this->tabela  {$insert_values} {$where_sql};");
                     
            if ($r->execute()) {
                return $r->fetchAll();
            } else {
                print_r($r->errorInfo());
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    
    
    public function update(array $campos_values, $where) {
        $where_sql = empty($where) ? "" : "WHERE " . $where;
        $sql_text_array = array();
        foreach ($campos_values as $campo => $valor) {
            array_push($sql_text_array, "{$campo}='{$valor}'");
        }
        $sql_text = implode(",", $sql_text_array);
        $r = $this->pdo->prepare("UPDATE {$this->tabela} SET {$sql_text} {$where_sql}");
        $r->execute();
        return $r->rowCount();
    }
    public function delete($where = null) {
        try {
            
            $where_sql = empty($where) ? "" : "WHERE " . $where;
            $r = $this->con->conecta()->prepare("DELETE FROM $this->tabela {$where_sql};");
            print_r($r);
            $r->execute();
            return TRUE;
            //return $r->rowCount();
        } catch (PDOException $ex){
                echo $ex->getMessage();
        }
    }
}
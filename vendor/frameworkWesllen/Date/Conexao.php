<?php
namespace FrameworkWesllen\Date;
use PDO;
//Faz o estanciamento da conexao com o servidor
class conexao {
    private $usuario;
    private $senha;
    private $servidor;
    private $dbName;
    private static $pdo;
    public function __construct() {
        $this->usuario = "root";
        $this->servidor = "localhost";
        $this->dbName = "einstein";
        $this->senha = "";
    }
    public function conecta() {
        try {
            if (is_null(self::$pdo)) {
                self::$pdo = new PDO("mysql:host=".$this->servidor."; dbname=".$this->dbName, $this->usuario, $this->senha);
            }
            return self::$pdo;
        } catch (PDOException $ex) {
            die("Erro: <code>" . $ex->getMessage() . "</code>");
        }
    }
}

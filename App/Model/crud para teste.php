<?php

require_once '../Controller/FuncoesController.php';
require_once 'conexao.php';

class crud {

    private $cpf;
    private $dataNasc;
    private $nome;
    private $senha;
    private $salt;
    private $email;
    private $funcao;
    private $con;
    private $dataCadas;
    private $id_role;

    public function __construct() {
        $this->con = new conexao();
        $this->funcao = new FuncoesController();
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }

    public function __get($atributo) {
        return $this->$atributo;
    }
    
    public function inserir($dados){
        try {            
        $this->nome = $this->funcao->tratarCaracter($dados['nome'], 1);
        $this->dataNasc = $dados['dataNasc'];
        $this->cpf = $dados['cpf'];
        $this->email = $dados['email'];
        $this->senha = $this->funcao->base64($dados['senha'], 2);
        $this->salt = $this->funcao->base64($dados['senha'], 4);
        $this->dataCadas = $this->funcao->dataAtual(2);  
        $this->id_role = 2; // 1-Administrador. 2-User comun
        
        $query = $this->con->conecta()->prepare("INSERT INTO users (nome, email, senha, cpf, dataNasc, dataCad, salt, role_id) VALUES(:nome, :email, :senha, :cpf, :dataNasc, :dataCad, :salt, :role_id);");
        $query->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $query->bindParam(':email', $this->email, PDO::PARAM_STR);
        $query->bindParam(':senha', $this->senha, PDO::PARAM_STR);
        $query->bindParam(':cpf', $this->cpf, PDO::PARAM_STR);
        $query->bindParam(':dataNasc', $this->dataNasc, PDO::PARAM_STR);        
        $query->bindParam(':dataCad', $this->dataCadas, PDO::PARAM_STR);
        $query->bindParam(':salt', $this->salt, PDO::PARAM_STR);
        $query->bindParam(':role_id', $this->id_role, PDO::PARAM_STR);
            if($query->execute()){            
                return 'ok';
            }else{
                //Mostra o que está errado
                print_r($query->errorInfo());
            } 
                
            
        } catch (PDOException $ex) {
            die("Erro: <code>" . $ex->getMessage() . "</code>");
            
        }
        
    }
    
    public function logar($dados){
        try {
        $this->email = $dados['email'];
        $this->senha = $dados['senha'];
        $query = $this->con->conecta()->prepare("SELECT * FROM users WHERE email = :email and senha = :senha;");
        $query->bindParam(':email', $this->email, PDO::PARAM_STR);
        $query->bindParam(':senha', $this->senha, PDO::PARAM_STR);
        $query->execute();
        if($query->rowCount() == 0){
            

                return 'erro';
            }else{
                $ln = $query->fetch() ;
                    session_start();
                    $_SESSION['LOGIN'] = 'sim';
                    $_SESSION['email'] = $ln['email'];
                    $_SESSION['senha'] = $ln['senha'];
                    $_SESSION['nome'] = $ln['nome'];
                    $_SESSION['dataNasc'] = $ln['dataNasc'];
                    $_SESSION['cpf'] = $ln['cpf'];
                    $_SESSION['dataCadas'] = $ln['dataCadas'];               
  
               
                
                return 'ok';                
            }
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
        
    }
    
    //Verificar se ja existe no banc de dados Email e CPF cadastrado
    public function selecionar($dados){
        try {                
        $this->cpf = $dados['cpf'];
        $this->email = $dados['email'];        
        $query = $this->con->conecta()->prepare("SELECT * FROM users WHERE email = :email and cpf = :cpf");
        $query->bindParam(':email', $this->email, PDO::PARAM_STR);
        $query->bindParam(':cpf', $this->cpf, PDO::PARAM_STR);        
        $query->execute();
        if($query->rowCount() != 0){                       
                return 'existe';
            }else{           
                return 'ok';                
            } 
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }
     
}

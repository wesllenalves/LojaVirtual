<?php
namespace App\Model\Admin;
use FrameworkWesllen\Date\Model;

class TabelaProdutos extends Model{
    
    
    
    public function ler(){
        
        $codicoes =  "produto as p JOIN fornecedor as f ON p.FKFornecedor = f.  codigoFornecedor";
        $dados = $this->readJoin($codicoes, "*");
        return $dados;
    }
    
    public function editar($id){
        $sql = "produto as p JOIN fornecedor as f ON p.FKFornecedor = f.  codigoFornecedor";
        $dados = $this->readChave($sql, "*", "codigoProduto = '$id'");
        
        return $dados;
    }
}

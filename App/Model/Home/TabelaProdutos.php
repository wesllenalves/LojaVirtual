<?php
namespace App\Model\Home;
use FrameworkWesllen\Date\Model;

class TabelaProdutos extends Model{
    
    
    
    
    public function ler(){
        $codicoes =  "produto as p JOIN fornecedor as f ON p.FKFornecedor = f.  codigoFornecedor";
        $dados = $this->readChave($codicoes);        
        return $dados;
    }
}

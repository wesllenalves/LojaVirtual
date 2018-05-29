<?php
namespace App\Model\Admin;
use FrameworkWesllen\Date\Model;

class InsertProdutos extends Model{
    
     //seleciona a tabela
    protected $tabela1 = "fornecedor";
    protected $tabela2 = "produto";
    protected $chaveEstrangeira = "FKFornecedor";
    
    public function CheckIsNull(array $array) {
        if ($array['nomeProduto'] == '' || $array['descricaoProduto'] == '' || $array['quantidadeProduto'] == '' ||
                $array['valor'] == '' || $array['nomeFornecedor'] == '' || $array['cnpjFornecedor'] == '' || $array['telefoneFornecedor'] == '' || $array['emailFornecedor'] == '' ) {
            return TRUE;
        }
        return FALSE;
    }
    
    
    public function inserirPoduto(array $array){
        
//        $this->tabela1;
//        $this->tabela2;
//        $query = $this->con->conecta()->prepare("INSERT INTO $this->tabela1 ({$insert_campos}) VALUES('{$insert_values}');");
//            if ($query->execute()) {
//                $last_id = $query->lastInsertId();
//                return TRUE;
//            } else {
//                print_r($query->errorInfo());
//            }
//        
//        
//        
//        
//    }
//        try {
//            $campos_array = array_keys($campos_values);
//            $values_array = array_values($campos_values);
//            $insert_campos = implode(",", $campos_array);
//            $insert_values = implode("','", $values_array);
//            $query = $this->con->conecta()->prepare("INSERT INTO $this->tabela ({$insert_campos}) VALUES('{$insert_values}');");
//            if ($query->execute()) {
//                return TRUE;
//            } else {
//                print_r($query->errorInfo());
//            }
//        
//        
//        
//        
//        
//        mysqli_query($conn, "INSERT INTO fornecedor (cnpj, nomeFornecedor, telefone, email) VALUES ('$cnpjFornecedor', '$nomeFornecedor', '$telefoneFornecedor', '$emailFornecedor')");
//        
//        $sql1 = "INSERT INTO produto(nomeProduto, descricaoProduto, qtdEstoque, valor, fotoProduto, FKFornecedor) values ('$nomeProduto', '$descricaoProduto', '$quantidadeProduto', '$valor', '$imagemProduto', '$id')";
//    $query1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
  }
    
    
    
}

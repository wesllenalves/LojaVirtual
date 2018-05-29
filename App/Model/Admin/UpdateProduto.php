<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Admin;

use FrameworkWesllen\Date\Model;

/**
 * Description of UpdateProduto
 *
 * @author Wesllen
 */
class UpdateProduto extends Model {

    public function updateProduto() {
        session_start();

        $nomeProduto = $_POST['nomeProduto'];
        $descricaoProduto = $_POST['descricaoProduto'];
        $quantidadeProduto = $_POST['quantidadeProduto'];
        $valor = $_POST['valor'];
        $nomeFornecedor = $_POST['nomeFornecedor'];
        $cnpjFornecedor = $_POST['cnpjFornecedor'];
        $telefoneFornecedor = $_POST['telefoneFornecedor'];
        $emailFornecedor = $_POST['emailFornecedor'];
        $idFornecedor = $_POST['idFornecedor'];
        $idProduto = $_POST['idProduto'];
        $arquivo = $_FILES['imagem'];
        date_default_timezone_set('America/Sao_Paulo');
        $date = date("Y-m-d H:i:s");
//        

        if (!empty($_FILES['imagem']['size']) > 0) {
            $_UP['extensoes'] = array('png', 'jpg', 'jpeg', 'gif');
            //Tamanho máximo do arquivo em Bytes
            $_UP['tamanho'] = 1024 * 1024 * 100; //5mb
            // Faz a verificação da extensao do arquivo			
            $extensao = @strtolower(end(explode('.', $_FILES['imagem']['name'])));

            $novo_nome = md5(time()) . "." . $extensao;



            $diretorio = __DIR__ . "/../../../public_html/img/produtos/";

            if (array_search($extensao, $_UP['extensoes']) === false) {

                echo "A imagem não foi cadastrada extesão inválida.";
            } else if ($_UP['tamanho'] < $_FILES['imagem']['size']) {
                echo "Arquivo muito grande.";
            } else {
                if (move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio . $novo_nome)) {

                    $sql = array('cnpj' => $cnpjFornecedor, 'nomeFornecedor' => $nomeFornecedor, 'telefone' => $telefoneFornecedor, 'email' => $emailFornecedor, 'DataModificado' => $date);

                    $dados = $this->update($sql, "Fornecedor", "codigoFornecedor = '$idFornecedor'");
                    if ($dados) {
                        $sql1 = array("nomeProduto" => $nomeProduto, "descricaoProduto" => $descricaoProduto, "qtdEstoque" => $quantidadeProduto,
                            "valor" => $valor, "DataModificado" => $date);

                        $this->update($sql1, "Produto", "codigoProduto = '$idProduto'");
                        $_SESSION['success'] = "Sucesso: Atualizado corretamente!";
                        return TRUE;
                    } else {
                        return FALSE;
                    }
                }
            }
        } else {

            $sql = array('cnpj' => $cnpjFornecedor, 'nomeFornecedor' => $nomeFornecedor, 'telefone' => $telefoneFornecedor, 'email' => $emailFornecedor, 'DataModificado' => $date);

            $dados = $this->update($sql, "Fornecedor", "codigoFornecedor = '$idFornecedor'");

            if ($dados) {


                $sql1 = array("nomeProduto" => $nomeProduto, "descricaoProduto" => $descricaoProduto, "qtdEstoque" => $quantidadeProduto,
                    "valor" => $valor, "DataModificado" => $date);

                $this->update($sql1, "Produto", "codigoProduto = '$idProduto'");


                $_SESSION['success'] = "Sucesso: Atualizado corretamente!";
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

}

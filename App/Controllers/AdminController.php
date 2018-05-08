<?php

/**
 * *description* Essa classe AdminController é um controller que vai cuidar de todas a parte de gerenciamento das paginas
 * com acesso restrito por autenticação, por tanto gerenciara as rederização das views e o contato com as classe
 * de negocio nas models
 * @method Public index() renderizar index/admin
 * @method Public produto() renderizar index/produto
 * @method Public profile() renderizar index/profile
 * @method Public adicionarView() renderizar /admin/produtos/adicionar
 * @method Public adicionar() renderizar /admin/produtos/adicionar
 * @author Wesllen Masoliiny <wesllenalves@gmail.com>
 */

namespace App\Controllers;

use App\Controllers\BaseControllers\baseAdminController;
use App\Model\Admin\TabelaProdutos;
use App\Model\Admin\InsertProdutos;
use App\Model\Admin\Logout;

/**
 * Essa classe @extends da classe BaseAdminController
 */
class AdminController extends baseAdminController {

    /**
     * Esse metodo <b>index</b>redenriza a view index da pagina Admin.
     * Só poderar ser acessada se o cliente estiver autenticado caso contrario sera redirecionado a index
     * do controller <b>HomeController</b> 
     */
    public function index() {
        $this->service->render('Admin/index.phtml');
    }

    /**
     * Esse metodo <b>produto</b> instancia um novo objeto <b>model</b>  da classe  filha <b>TabelaProdutos</b>
     * cria uma condição e armazena e um variavel passa essa variavel para classe pai <b>readChave</b> trazendo
     * todos o dados na tabela relacionados a condições e armazenado em uma variavel lançando essa variavel para
     * a view produtos para ser ixibido os dados
     */
    public function produto() {
        $model = new TabelaProdutos();
        $codicoes = array("condicao" => "JOIN fornecedor as f ON p.FKFornecedor = f.  codigoFornecedor");
        $dados['Produtos'] = $model->readChave($codicoes, $campos = "*", $where = "");
        $this->service->render('Admin/produtos.phtml', $dados);
    }

    /**
     * Esse @method <b>Profile</b> rederiza a view index da pagina profile
     */
    public function profile() {
        $this->service->render('Admin/pages-profile.phtml');
    }

    /**
     * Esse @method <b>adicionarView</b> rederiza a view index da pagina produtos
     */
    public function adicionarView() {

        $this->service->render('Admin/adicionarProdutos.phtml');
    }

    /**
     * Esse @method <b>adicionar</b> trabalha com toda a logica de contactar a a classe model @model 
     * <b>InsertProdutos</b> e moder a foto do produto para a pasta especificada
     */
    public function adicionar() {

        if ($_FILES['imagem'] && !empty($_FILES['imagem']['tmp_name'])) {
            $_UP['extensoes'] = array('png', 'jpg', 'jpeg', 'gif');
            //Tamanho máximo do arquivo em Bytes
            $_UP['tamanho'] = 1024 * 1024 * 100; //5mb
            // Faz a verificação da extensao do arquivo			
            $extensao = explode('.', $_FILES['imagem']['name']);
            $extensao_saida = end($extensao);

            //$novo_nome = md5(time()) . "." . $extensao;
            $novo_nome = $_POST["nomeProduto"] . "." . $extensao_saida;
            $diretorio = "./public_html/img/produtos/";
            if (array_search($extensao_saida, $_UP['extensoes']) === false) {
                echo "A imagem não foi cadastrada extesão inválida.";
            } else if ($_UP['tamanho'] < $_FILES['imagem']['size']) {
                echo "Arquivo muito grande.";
            } else {
                if (move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio . $novo_nome)) {
                    
                }
            }
        } else {
            echo 'não existe';
        }

        $modelProdutos = new InsertProdutos();
        if ($modelProdutos->CheckIsNull($_POST) == TRUE) {
            echo 'Por favor preencha os dados';
        } else {
            $dados = array(
                "0" =>
                array(
                    "nomeProduto" => $_POST["nomeProduto"], "descricaoProduto" => $_POST["descricaoProduto"],
                    "qtdEstoque" => $_POST["quantidadeProduto"], "valor" => $_POST["valor"], "fotoProduto" => $novo_nome
                ),
                "1" =>
                array(
                    "cnpj" => $_POST["cnpjFornecedor"], "nomeFornecedor" => $_POST["nomeFornecedor"],
                    "telefone" => $_POST["telefoneFornecedor"], "email" => $_POST["emailFornecedor"])
            );

            if ($modelProdutos->insertEstrangeiro($dados)) {
                session_start();
                $_SESSION['success'] = "Cadastrado com Sucesso";
                $r = base_url('');
                header("Location: $r/admin/produtos");
                exit;
            }
        }
    }
    
    /**
     * Esse @method destroi a sessao criada e redireciona o cliente para a view index do controller HomeController
     */
    public function sair() {
        $model = new Logout();
        $model->logout();
        $this->response->redirect('/index')->send();
    }

}

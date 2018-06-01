<?php

/**
 * *description* Essa classe HomeController é um controller que vai cuidar de todas a parte de gerenciamento das paginas
 * com aceso do public externo, por tanto gerenciara as rederização das views e o contato com as classe
 * de negocio nas models
 * @method Public index() renderizar index/
 * @method Public login() renderizar /index/login
 * @method Public verificaLogin() renderizar /index/login
 * @method Public cadastroView() renderizar /index/cadastro
 * @method Public cadastro() renderizar /index/cadastro
 * @method Public sair() renderizar /index/sair
 * @author Wesllen Masoliiny <wesllenalves@gmail.com>
 */

namespace App\Controllers;

use App\Controllers\BaseControllers\baseHomeController;
use App\Helps\Funcoes;
use App\Model\Home\Login;
use App\Model\Home\Produtos;
use App\Model\Home\Loginatteempt;
use App\Model\Home\MinhaConta;
use App\Model\Home\Cliente;
use App\Model\Home\Endereco;

/**
 * Essa classe @exteds da classe baseHomeController
 */
class HomeController extends baseHomeController {

    /**
     * Esse @method <b>index</b> vai se comunicar com a classes da model @class TabelaProdutos
     * trazendo todos os produtos cadastrados no banco de dados para a tela inicial
     */
    private $Produto;

    public function __construct() {
        $this->Produto = new Produtos();
    }

    public function index() {        
        $dados = $this->Produto->with('Fornecedor')->get();
        $dado['Produtos'] = json_decode($dados, true);
        $this->service->render('Home/index.phtml', $dado);
    }

    /**
     * Esse @method <b>login<b> renderiza a view da tela de login
     */
    public function login() {
        $this->service->render('Home/login.phtml');
    }

    /**
     * Esse @method <b>verificaLogin</b> faz a ligação com a model @class Login
     * faz todas as verificações ´se existir os dados preenchidos pelo cliente e redirecionado a pagina
     * autnticada caso contrario e redirecionada a view de login com mensagem de erro.
     */
    public function verificaLogin() {
        session_start();
        $fazerLog = filter_input(INPUT_POST, 'fazerLog');
        //$attemps = new Loginatteempt();
        if (isset($fazerLog)) {
            $model = new Login();
            if (Cliente::CheckIsNullLogin(filter_input_array(INPUT_POST, FILTER_DEFAULT)) === TRUE) {
                $_SESSION['erro'] = "Preencha todos os campos";
                $this->response->redirect('/index/login')->send();
                exit;
            } elseif (Cliente::VerificarTentativas(filter_input_array(INPUT_POST, FILTER_DEFAULT)) != TRUE) {
                $_SESSION['erro'] = "Você alcançou o numero de 10 tentativas frustadas de login entre em contato com o administrador";
                $this->response->redirect('/index/login')->send();
           } //else {
//                $result = $model->autentication(filter_input_array(INPUT_POST, $_POST));
//                if ($result) {
//                    session_start();
//                    if (($_SESSION["tipoUsuario"]) === "comun") {
//                        $this->response->redirect('/index/minhaconta')->send();
//                    } else {
//                        $this->response->redirect('/admin')->send();
//                    }
//                } else {
//                    $_SESSION['erro'] = "Usuário inválido";
//                    $this->response->redirect('/index/login')->send();
//                    exit;
//                }
//            }
        }
    }

    /**
     * Esse @method <b>cadastroView</b> faz a redenrização da view de cadastro
     */
    public function cadastroView() {
        $this->service->render('Home/cadastro.phtml');
    }

    /**
     * Esse @method <b>Cadasta<b> faz a validação junto a model @class CadastroUser verifica se já existe 
     * cadastro igual no banco de dados caso exista e redirecionado para a view de cadastro apresentando erro
     * caso contrario e redirecionado para a pagina de login com a messagem de cadastro efetuado com sucesso.
     */
    public function cadastra() {
        session_start();
        $funcoes = new Funcoes();
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $nome = addslashes($post['nome']);
        $email = addslashes($post['email']);
        $senha = addslashes($post['senha']);
        $salt = password_hash($senha, PASSWORD_DEFAULT);
        $cpf = addslashes($post['cpf']);
        $dataNasc = addslashes($post['dataNasc']);
        $celular = addslashes($post['celular']);
        $telefoneFixo = addslashes($post['telefoneFixo']);
        $tipoUsuario = "comun";
        $cep = addslashes($post['cep']);
        $rua = addslashes($post['rua']);
        $bairro = addslashes($post['bairro']);
        $cidade = addslashes($post['cidade']);
        $estado = addslashes($post['uf']);
        $complemento = addslashes($post['complemento']);

        if (Cliente::CheckIsNull(filter_input_array(INPUT_POST, FILTER_DEFAULT)) == TRUE) {
            $_SESSION['erro'] = "Por favor digite todos os Campos";
            $this->response->redirect('/index/cadastro')->send();
            exit;
        } elseif (Endereco::CheckIsNull(filter_input_array(INPUT_POST, FILTER_DEFAULT)) == TRUE) {
            $_SESSION['erro'] = "Por favor digite todos os Campos";
            $this->response->redirect('/index/cadastro')->send();
            exit;
        } elseif (Cliente::CheckCpf(filter_input_array(INPUT_POST, FILTER_DEFAULT)) == TRUE) {
            //verifica se o cpf e valido se nao redireciono para a pagina cadastro com uma sessao de erro
            $_SESSION['erro'] = "Por favor digite um CPF válido!";
            $this->response->redirect('/index/cadastro')->send();
            exit;
        } elseif (Cliente::CheckRepitaSenha(filter_input_array(INPUT_POST, FILTER_DEFAULT))) {
            //Verifica se as senhas conicidem se não volta para pagina de castrados com uma sessao de erro
            $_SESSION['erro'] = "Por favor digite as senhas iguais";
            $this->response->redirect('/index/cadastro')->send();
            exit;
        } elseif (Cliente::ExitsUser(filter_input_array(INPUT_POST, FILTER_DEFAULT))) {
            $_SESSION['erro'] = "Ja Existe os Mesmos Dados Cadastrados no Banco";
            $this->response->redirect('/index/cadastro')->send();
            exit;
        } else {
            $dadosForm = [
                "nomeCliente" => $nome, "email" => $email, "senha" => $funcoes->base64($senha, 1), "salt" => $salt,
                "cpf" => $cpf, "dataNas" => $dataNasc, "celular" => $celular, "telefoneFixo" => $telefoneFixo,
                "tipoUsuario" => $tipoUsuario, "dataCadas" => $funcoes->dataAtual(2), "cep" => $cep, "rua" => $rua,
                "bairro" => $bairro, "cidade" => $cidade, "estado" => $estado, "complemento" => $complemento
            ];

            $cliente = Cliente::create($dadosForm);
            if ($cliente) {
                $cliente->endereco()->create($dadosForm);
                $_SESSION['success'] = "Cadastrado com Sucesso";
                $this->response->redirect('/index/cadastro')->send();
                exit;
            } else {
                $_SESSION['erro'] = "Não foi possivel fazer seu Cadastro por favor entre em contato com email suporte@suport.com";
                $this->response->redirect('/index/cadastro')->send();
                exit;
            }
        }
    }

    public function minhaconta() {
        $ler = new MinhaConta();
        $dados['clientes'] = $ler->ler();

        $this->service->render('Home/minhaconta.phtml', $dados);
    }

}

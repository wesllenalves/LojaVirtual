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
use App\Model\Home\TabelaProdutos;
use App\Model\Home\CadastroUser;
use App\Model\Home\Loginatteempt;

/**
 * Essa classe @exteds da classe baseHomeController
 */
class HomeController extends baseHomeController {

    /**
     * Esse @method <b>index</b> vai se comunicar com a classes da model @class TabelaProdutos
     * trazendo todos os produtos cadastrados no banco de dados para a tela inicial
     */    
    public function index() {
        $model = new TabelaProdutos();

        //podera so passar a condição diretamente 
        $codicoes = array("condicao" => "JOIN fornecedor as f ON p.FKFornecedor = f.  codigoFornecedor");
        
        //Exemplo Trazer um objeto especifico      
        // $dados['Produtos'] = $model->readChave($codicoes, $campos = "*", $where= "codigoProduto = 1");  
        
        //Trazer todos objetos
        $dados['Produtos'] = $model->readChave($codicoes);
        $this->service->render('Home/index.phtml', $dados);
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
        $attemps = new Loginatteempt();
        if (isset($fazerLog)) {
            $model = new Login();
            if ($model->CheckIsNull(filter_input_array(INPUT_POST, $_POST)) === TRUE) {
                $_SESSION['erro'] = "Preencha todos os campos";
                $this->response->redirect('/index/login')->send();
                exit;            
     } elseif ($model->VerificarTentativas($_POST) != TRUE) {
            $_SESSION['erro'] = "Você alcançou o numero de 8 tentativas frustadas de login entre em contato com o administrador";
            $this->response->redirect('/index/login')->send();
        } else {           
                $result = $model->autentication(filter_input_array(INPUT_POST, $_POST));
                if ($result) {
                    $this->response->redirect('/admin')->send();
                } else {                  
                    $_SESSION['erro'] = "Usuário inválido";
                    $this->response->redirect('/index/login')->send();
                    exit;
                }
            }
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
        $model = new CadastroUser();
        $funcoes = new Funcoes();

        if ($model->CheckIsNull(filter_input_array(INPUT_POST, $_POST)) == TRUE) {
            $_SESSION['erro'] = "Por favor digite todos os Campos";
            $this->response->redirect('/index/cadastro')->send();
            exit;
        } elseif ($model->CheckCpf(filter_input_array(INPUT_POST, $_POST)) == TRUE) {
            //verifica se o cpf e valido se nao redireciono para a pagina cadastro com uma sessao de erro
            $_SESSION['erro'] = "Por favor digite um CPF válido!";
            $this->response->redirect('/index/cadastro')->send();
            exit;
        } elseif ($model->CheckRepitaSenha(filter_input_array(INPUT_POST, $_POST))) {
            //Verifica se as senhas conicidem se não volta para pagina de castrados com uma sessao de erro
            $_SESSION['erro'] = "Por favor digite as senhas iguais";
            $this->response->redirect('/index/cadastro')->send();
            exit;
        } elseif ($model->ExitsUser(filter_input_array(INPUT_POST, $_POST))) {
            $_SESSION['erro'] = "Ja Existe os Mesmos Dados Cadastrados no Banco";
            $this->response->redirect('/index/cadastro')->send();
            exit;
        } else {
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
            $salt = password_hash($senha, PASSWORD_DEFAULT);
            $cpf = addslashes($_POST['cpf']);
            $dataNasc = addslashes($_POST['dataNasc']);
            $celular = addslashes($_POST['celular']);
            $telefoneFixo = addslashes($_POST['telefoneFixo']);
            $tipoUsuario = 0;

            $cep = addslashes($_POST['cep']);
            $rua = addslashes($_POST['rua']);
            $bairro = addslashes($_POST['bairro']);
            $cidade = addslashes($_POST['cidade']);
            $estado = addslashes($_POST['uf']);
            $complemento = addslashes($_POST['complemento']);


            $dados = array(
                "0" =>
                        array(
                            "nomeCliente" => $nome, "email" => $email, "senha" => $funcoes->base64($senha, 1),
                            "salt" => $salt, "cpf" => $cpf, "dataNas" => $dataNasc,
                            "celular" => $celular, "telefoneFixo" => $telefoneFixo, "tipoUsuario" => $tipoUsuario, "dataCadas" => $funcoes->dataAtual(2)
                        ),
                "1" =>
                        array(
                            "cep" => $cep, "rua" => $rua, "bairro" => $bairro, "cidade" => $cidade,
                            "estado" => $estado, "complemento" => $complemento
                        )
                
            );            

           
            if ($model->insertEstrangeiro($dados)) {
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
}

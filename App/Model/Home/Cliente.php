<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Home;
use App\Model\Home\Loginatteempt;
use FrameworkWesllen\ModelEloquent;

/**
 * Description of Cliente
 *
 * @author Wesllen
 */
class Cliente extends ModelEloquent {

    public $table = "cliente";
    public $timestamps = false;
    protected $primaryKey = "id";
    protected $fillable = ['id', 'nomeCliente', 'email', 'senha', 'salt', 'cpf', 'dataNas', 'celular', 'telefoneFixo', 'tipoUsuario', 'dataCadas'];

    public function endereco() {
        return $this->hasOne(Endereco::class, 'cliente_id', 'id');
    }
    
    public function loginatteempt(){
        return $this->hasOne(Loginatteempt::class, 'user_id', 'id');
    }


    //verifica se o cpf digitado e valido
    public function CheckCpf(array $array) {
        $cpf = strlen($array['cpf']);

        if ($cpf >= 12 || $cpf < 11) {
            return TRUE;
        }
        return FALSE;
    }
    
    public static function CheckIsNull(array $array) {
        if ($array['nome'] == '' || $array['email'] == '' || $array['senha'] == '' || $array['ReSenha'] == '' || 
            $array['cpf'] == '' || $array['dataNasc'] == '' || $array['celular'] == '' ) {
            return TRUE;
        }
        return FALSE;
    }
    public static function CheckIsNullLogin(array $array) {
        if ($array['email'] == '' || $array['senha'] == '' ) {
            return TRUE;
        }
        return FALSE;
    }
    
    //verifica se as senhas são iguais
    public static function CheckRepitaSenha(array $array) {
        if ($array['senha'] != $array['ReSenha']) {
            return TRUE;
        }
        return FALSE;
    }
    
    //Verifica se ja existe usuarios com os dados de email e cpf cadastrados
    public static function ExitsUser(array $array) {        
        $dadosUser = Cliente::all()->where('email', '=', $array['email'])->where('cpf', '=', $array['cpf']);

        if (count($dadosUser) > 0) {

            return TRUE;
        }
        return FALSE;
    }
    
    public static function VerificarTentativas(array $array){
        $attp = new Loginatteempt();        
        $dadosUser = Cliente::all()->where('email', '=', $array['email']);        
        $id = $dadosUser[0]['id'];        
        $result = $attp->TotalDeTentativas($id);
        if($result < 11){
            return TRUE; 
        }else{
            return FALSE;
        }
    }

    //Verifica se existe usuario cadastrado. Cria sessao caso exista
    public static function autentication(array $array) {
        $attp = new Loginatteempt();
        $funcao = new Funcoes();
        $email = addslashes($array['email']);
        $senha = addslashes($array['senha']);      
        $sql = "email='{$email}' and senha='{$funcao->base64($senha, 1)}';";       
        $dadosUser = $this->read("*", $sql);
        if (count($dadosUser) > 0) {
            
               $salt = $dadosUser[0]['salt'];
               
            if (password_verify($array["senha"], $salt)) {
                
                $login = $dadosUser[0];
                $id = $dadosUser[0];
                $user_id = $id['codigoCliente'];
                $attp->LimparTentativa($user_id);
                $data = Session::getInstance();
                $data->authenticado = TRUE;
                $data->login = $login["nome"];
                $data->logado = "";
                $data->id = $id['codigoCliente'];         
                $data->tipoUsuario = $login['tipoUsuario'];                   
                return TRUE;
            
            }
            
        }
        
        $email1 = addslashes($array['email']);
        $sql1 = "email='{$email1}';";
        $dadosUser1 = $this->read('*', $sql1);
        $user_id = $dadosUser1[0]; 
        $user_id = $user_id['codigoCliente'];
        
        
                
        $attp->TotalDeTentativas($user_id);
        $attp->RegistraTentativa($user_id);
        
        return FALSE;
    }

}

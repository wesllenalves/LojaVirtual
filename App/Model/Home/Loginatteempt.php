<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Home;
use FrameworkWesllen\Date\Model;
/**
 * Description of Loginatteempt
 *
 * @author laboratorio
 */
class Loginatteempt extends Model{
    
    protected $tabela = "login_attempts";
    
    public function TotalDeTentativas($id){    
        
        if(!is_null($id)){
            $user_id = $id[0];           
            
           $id_user = $user_id['codigoCliente'];
           
           $sql1 = "user_id='{$id_user}'"; 
                   
           $dados1 =  $this->read('*', $sql1);
           
           return count($dados1);
          //return $user_id;
        }       
    }
    
    public function RegistraTentativa($id){
        
        
        //$user_id = $user_id[0];            
        $user_id = $id['codigoCliente'];        
        $dados = array("user_id" => $user_id);
        
        $inserir = $this->insert($dados);
        
        
    }
    
    public  function LimparTentativa($user_id){
        $user_id = $user_id[0];            
        $user_id = $user_id['codigoCliente'];
        $where_sql = "user_id='{$user_id}'";
        if($delatar = $this->delete($where_sql)){
            
        }
    }
        
    
}

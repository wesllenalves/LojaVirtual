<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Home;
use FrameworkWesllen\ModelEloquent;
use App\Model\Home\Cliente;
/**
 * Description of Loginatteempt
 *
 * @author laboratorio
 */
class Loginatteempt extends ModelEloquent{

    public $table = "login_attempts";
    public $timestamps = false;
    protected $primaryKey = "id";
    protected $fillable = ['id', 'user_id', 'created_at'];
    
    public function cliente(){
        return $this->hasOne(Cliente::class);
    }
    
    public function TotalDeTentativas($id){    
        
        if(!is_null($id)){            
           $dados1 = Loginatteempt::all()->where('user_id', '=', $id);           
           return count($dados1);          
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

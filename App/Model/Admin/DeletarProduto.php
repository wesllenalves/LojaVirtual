<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Admin;
use FrameworkWesllen\Date\Model;
/**
 * Description of DeletarProduto
 *
 * @author Wesllen
 */
class DeletarProduto extends Model{
   
    protected $tabela = 'produto';
    
    public function deletando($id){
        session_start();
        $deletando = $this->delete("codigoProduto = {$id}");
        if($deletando){
            $_SESSION['success'] = "Sucesso: Atualizado corretamente!";
            return TRUE;
        }else{
            $_SESSION['erro'] = "Erro: Ao tentar atualizado!";
            return FALSE; 
        }
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Home;
use FrameworkWesllen\ModelEloquent;
use App\Model\Home\Produtos;

class Fornecedor extends ModelEloquent{
   public $table = "fornecedor";
   public $timestamps = false;
   protected $primaryKey = 'user_id';
  protected $fillable   = ['user_id', 'cnpj', 'nomeFornecedor', 'telefone', 'email', 'DataModificado'];
    
   public function Produtos() {
        return $this->belongsTo(Produtos::class);
    }
   
}

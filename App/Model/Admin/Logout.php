<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Logout
 *
 * @author laboratorio
 */
namespace App\Model\Admin;
use FrameworkWesllen\Date\Session;

class Logout {
    
    //Faz a destruição da sessao
    public function logout(){
        $data = Session::getInstance();
        $data->destroy();
    }
}

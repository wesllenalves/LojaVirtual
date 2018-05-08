<?php

namespace FrameworkWesllen\Http;
use \Klein\ServiceProvider;

class View extends ServiceProvider{
    
    public function render($view, array $data = array()){
        parent::render(VIEW.$view, $data);
    }
}

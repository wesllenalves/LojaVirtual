<?php

//ROTA HOME DOS SITE//
$route->get("/", "Home@Index");
$route->get("/index", "Home@Index");
$route->get("/index/login", "Home@login");
$route->post("/index/login", "Home@verificaLogin");
$route->get("/index/cadastro", "Home@cadastroView");
$route->post("/index/cadastro", "Home@cadastra");
$route->get("/index/minhaconta", "Home@minhaconta");

//ROTA HOME DOS SITE//
//
//ROTA DE ADMINISTRADOR//
$route->get("/admin", "Admin@Index");
$route->get("/admin/produtos", "Admin@produto");
$route->get("/admin/produtos/adicionar", "Admin@adicionarView");
$route->post("/admin/produtos/adicionar", "Admin@adicionar");
$route->get("/admin/produtos/remover", "Admin@removerProduto");
$route->get("/admin/produtos/editar", "Admin@editarProdutos");
$route->post("/admin/produtos/editando", "Admin@editarProd");
$route->get("/admin/profile", "Admin@profile");
$route->get("/admin/sair", "Admin@sair");
//ROTA DE ADMINISTRADOR//
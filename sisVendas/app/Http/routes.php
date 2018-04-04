<?php

/*
/------------------------------------------------------------------------
/Application Routes
/
/Aqui é onde você pode registrar todas as rotas para a aplicação.
/É simples, Laravel fala com a UrIs e ela deve responder para dar
/ para o contralador para chamar quando aquela Uri é requerida
/
*/

Route::get('/', function(){
    return view('welcome');
});

Route::resource('almacen/categoria/','CategoriaController');
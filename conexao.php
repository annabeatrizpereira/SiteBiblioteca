<?php
    // defining the credentials to the connection 
    define('HOST', '127.0.0.1');
    define('USUARIO', 'root');
    define('SENHA', '');
    define('DB', 'bdbiblioteca'); 

    // setting all together
    $conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar');
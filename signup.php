<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Sign Up | Etec de Araçatuba</title>
    <link rel="icon" href="./images/book.svg" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Roboto:wght@400;500;700&display=swap"
    />
    <link rel="stylesheet" href="./css/initial.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
      <header>
          <h2>Etec</h2>
      </header>
    
      <main class="main-signup">
          <div class="container-signup">
            <div class="center"><h1>Fazer Cadastro</h1></div>
            <form action="cadastrar.php" method="post">
              <div class="boxes-signup">
                <p>Nome Completo</p>
                <input 
                    type="text" 
                    name="nome" 
                    class="letters-only"
                    onkeydown="return alphaOnly(event);"
                    onblur="return alphaOnly(event);"
                    onfocus="return alphaOnly(event);">
                
                <p>Data de Nascimento</p>
                <input type="date" name="data">
                <p>E-mail institucional</p>
                <input type="email" name="usuario">
                <p>Senha</p>
                <input type="password" name="senha">
                <p>Confirmar senha</p>
                <input type="password" name="confirmar-senha">
              </div>   
              <div class="center"><button type="submit" id="btn-signup">CRIAR CONTA</button></div>
            </form>
            
            <?php
            if(isset($_SESSION['status_cadastro'])):
            ?>

            <div class="green">
              <p>Cadastro efetuado!<a href="login_page.php">Faça login informando o seu usuário e senha aqui.</a></p>
            </div> 

            <?php
            endif;
            unset($_SESSION['status_cadastro']);
            ?> 

            <?php
            if (isset($_SESSION['usuario_existe'])):
            ?>

            <div class="blue">
              <p>O email escolhido já existe. Informe outro e tente novamente.</p>
            </div>

            <?php
            endif;
            unset($_SESSION['usuario_existe']);
            ?>    
          
            <?php 
            if (isset($_SESSION['senhas_diferentes'])):
            ?>

            <div class="red">
              <p>As senhas informadas diferem uma da outra. Por favor, reescreva-as.</p>
            </div>

            <?php
            endif;
            unset($_SESSION['senhas_diferentes']);
            ?>

            
      </main>
      <footer> <p>2021 | Etec de Araçatuba</p> </footer>
  </body>

  <script>
    // to only accept letters and spaces
    function alphaOnly(event) { 
      var key = event.keyCode; 
      return ((key >= 65 && key <= 90) || key == 8 || key == 32); 
    }

    // after 5 seconds the messages will disappear 
    $().ready(function() {
      setTimeout(function () {
        $('.green').hide();
        $('.red').hide();
        $('.blue').hide();
        $('.purple').hide();
      }, 30000); 
    });

  </script>
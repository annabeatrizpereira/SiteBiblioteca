<?php
  // including the database connection
  include("conexao.php");
  include("verifica_login.php");
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
    <title>Fazer Devolução | Etec de Araçatuba</title>
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
    
      <main class="main-dev">
          <div class="container-signup">
            <div class="center"><h1>Fazer Devolução</h1></div>
            <form action="dev.php" method="post">
              <div class="boxes-signup">
                <p>Nome do aluno</p>
                <input type="text" name="nome-aluno">
                <p>Nome do arquivo escolhido</p>
                <input type="text" name="nome-livro">
                <p>Data do retorno</p>
                <input type="date" name="data-devolucao">
              </div>   
              <div class="center"><button type="submit" id="btn-signup">SALVAR</button></div>
            </form>  
            
      </main>

      <?php
        if(isset($_SESSION['fine'])):
      ?>

      <div class="green">
        <p>Devolução realizada com sucesso.</p>
      </div>

      <?php
        endif;
        unset($_SESSION['fine']);
      ?>

      <?php
        if(isset($_SESSION['bad'])):
      ?>

      <div class="red">
        <p>Erro: nome do aluno ou do arquivo incorreto.</p>
      </div>

      <?php 
        endif;
        unset($_SESSION['bad']);
      ?>

      <footer> <p>2021 | Etec de Araçatuba</p> </footer>
  </body>

  <script>
    // hiding the messages after 3 seconds
    $().ready(function() {
      setTimeout(function () {
        $('.emp-message').hide();
        $('.emp-bad').hide();
      }, 2500); 
    });
  </script>
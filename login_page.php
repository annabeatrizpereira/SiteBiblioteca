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
    <title>Login | Etec de Araçatuba</title>
    <link rel="icon" href="./images/book.svg" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Roboto:wght@400;500;700&display=swap"
    />
    <link rel="stylesheet" href="./css/initial.css" />
  </head>
  <body>

    <header>
      <h2>Etec</h2>
    </header>
    
    <main class="main-login">
      <div class="container-login">
    
          <div class="center"><h1>Fazer Login</h1></div>
          <div class="boxes">
            <form action="login.php" method="post">
            <p>E-mail institucional da Etec</p>
            <input type="email" name="usuario" required />
            <p id="password">Senha</p>
            <input type="password" name="senha" required />
           
            <?php
              if(isset($_SESSION['nao_autenticado'])):
            ?>

            <div>
              <small id="warning">ERRO: e-mail ou senha inválidos.</small>
            </div>

            <?php
              endif;
              unset($_SESSION['nao_autenticado']);
            ?>

          </div>

          <section class="end">
            <div class="end-one">
              <button type="submit">ENTRAR</button>
            </div>
            </form>
            <div class="end-two">
              <a href="./signup.php">Ainda não é cadastrado? Crie uma conta</a>
              <a href="./forgotpass.php">Esqueceu sua senha?</a>
            </div>
          </section>
          
          

      </div>
    </main>
    
    <footer>
      <p>2021 | Etec de Araçatuba</p>
   
    </footer>
  </body>
</html>

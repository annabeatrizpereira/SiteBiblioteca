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
    <title>Recuperar Senha | Etec de Araçatuba</title>
    <link rel="icon" href="./images/book.svg" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Roboto:wght@400;500;700&display=swap"
    />
    <link rel="stylesheet" href="./css/initial.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>

    <header>
      <h2>Etec</h2>
    </header>
    
    <main class="main-login">
      <div class="container-login">
    
          <div class="center"><h1>Recuperar Senha</h1></div>

          <div class="boxes">
            <form action="phpmailer.php" method="post">
            <p>E-mail institucional da Etec ou Gmail</p>
            <input type="email" name="email" required />
          </div>

          <section class="end">
            <div class="end-one">
              <button type="submit">ENVIAR</button>
            </div>
            </form>
          </section>


      </div>
    </main>

              
    <?php
      if(isset($_SESSION['email-sent'])):
    ?>

    <div class="green">
      <p>Um e-mail foi enviado para sua caixa de entrada. Por favor, confira-a.</p>
    </div>

    <?php
      endif;
      unset($_SESSION['email-sent']);
    ?>


    <?php 
      if(isset($_SESSION['no-email'])):
    ?>

    <div class="red">
      <p>Não encontramos este email em nosso banco de dados.<a href="./signup.php">Por favor, realize seu cadastro aqui.</a></p>
    </div>
    
    <?php
      endif;
      unset($_SESSION['no-email']);
    ?>
    
    <footer>
      <p>2021 | Etec de Araçatuba</p>
    </footer>
  </body>

<script>

// after 5 seconds the messages will disappear 
$().ready(function() {
  setTimeout(function () {
    $('.green').hide();
    $('.red').hide();
    $('.blue').hide();
    $('.purple').hide();
  }, 20000); 
});

</script>



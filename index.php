<?php
  // including the connection to the database
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
    <title>Biblioteca | Etec de Araçatuba</title>
    <link rel="icon" href="./images/book.svg" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Roboto:wght@400;500;700&display=swap"
    />
    <link rel="stylesheet" href="./css/style.css" />
    <script
      src="https://kit.fontawesome.com/2f00c44273.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>

    <header id="header-index">
      <nav>
        <div class="logo">
          <h1>Etec</h1>
        </div>
        <ul class="nav-links">
          <li><a href="#" id="home">INÍCIO</a></li>
          <li><a href="./ebooks.php">E-BOOKS</a></li>
          <li><a href="./profile.php">PERFIL</a></li>
          <li><a href="./logout.php">SAIR</a></li>    
        </ul>
        <div class="burguer">
          <div class="line1"></div>
          <div class="line2"></div>
          <div class="line3"></div>
        </div>
      </nav>
      <script src="./javascript/app.js"></script>
    </header>

    <main>

      <div class="img-um">
        <img class="background" src="./images/background.jpeg" />
      </div>
      
      <section class="section">
        <div class="blocks">
          <h2 class="titulos">Acervo</h2>
        <p>
          Confira todas as opções de livros e arquivos presentes na biblioteca
          principal da instituição. Aproveite para fazer buscas e pedidos!
        </p>
        <a href="./collection.php">
          <button> <span class="fas fa-arrow-right"></span></button>
        </a>
        </div>

        <div class="blocks">
          <h2 class="titulos">Biblioteca</h2>
        <p>
          Dados e materiais referentes ao TCC (Trabalho de Conclusão de Curso),
          no qual o setor bibliotecário é responsável.
        </p>
          <div class="dropdown">
            <button> <span class="fas fa-arrow-right"></span></button>
            <ul>
              <li>
                <a 
                    href="./doc/Manual_do_TCC.pdf" 
                    download="Manual do TCC">Manual do TCC
                </a>
              </li>
              <li>
                <a 
                    href="./doc/Regulamento_Geral_do_TCC.pdf" 
                    download="Regulamento Geral do TCC">Regulamento Geral do TCC
                </a>
              </li>
              <li>
                <a 
                    href="./doc/Termo_de_Autorizacao_e_Termo_de_Autenticidade (1).doc" 
                    download="Termo de Autorização e Autencidade">Termo de autorização e autencidade
                </a>
              </li>
              <li>
                <a 
                    href="./doc/manual-do-aluno.pdf" 
                    download="Manual do Aluno" >Manual do aluno
                </a>
              </li>
            </ul>
          </div>
        </div>
        
        <div class="blocks">
          <h2 class="titulos">Quem Somos</h2>
        <p>
          Tudo sobre a nossa instituição de ensino Etec de Araçatuba do Centro
          Paula Souza, desde sua fundação até os dias de hoje.
        </p>
        <a href="./about.php"> 
          <button> <span class="fas fa-arrow-right"></span></button> 
        </a>
        </div>
        
        <div class="blocks">
          <h2 class="titulos">Vestibulinho</h2>
        <p>
          As inscrições para o processo seletivo são feitas no site oficial da
          etec onde contém todas as informações necessárias. Confira!
        </p>
        <a href="https://www.vestibulinhoetec.com.br/home/"> 
          <button> <span class="fas fa-arrow-right"></span></button> 
        </a>
        </div>
      </section>

      <?php
        if(isset($_SESSION['admin'])):
      ?>

      <div class="action" onclick="actionToggle();">
        <div class="fab">+</div>
          <ul>
            <li><a href="./emprestimo.php">Novo Empréstimo</a></li>
            <li><a href="./devolution.php">Nova Devolução</a></li>
            <li><a href="./reservas.php">Reservas</a></li>
          </ul>
      </div>
      <script type="text/javascript">
        function actionToggle(){
          var action = document.querySelector('.action');
          action.classList.toggle('active')
        }
      </script>

      <?php 
        endif;
      ?>

      <hr />
      
    </main>
    
    <footer>
      <p>2020 | Etec de Araçatuba</p>
      <p id="address">
        Av. Prestes Maia, 1764 - Fone (18) 3622-0170 - Araçatuba-SP
      </p>
    </footer>
  </body>
</html>

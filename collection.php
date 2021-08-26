<?php
  /* including files */
  include("conexao.php");
  include("verifica_login.php");

  /* selecting the data to display on the screen */
  $consulta = "select ID_liv, nome_liv, autor_liv from livros order by nome_liv";
  $con = $conexao->query($consulta) or die($conexao->error);

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
    <title>Acervo | Etec de Araçatuba</title>
    <link rel="icon" href="./images/book.svg" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Roboto:wght@400;500;700&display=swap"
    />
    <link rel="stylesheet" href="./css/all.css" />
    <script
      src="https://kit.fontawesome.com/2f00c44273.js"
      crossorigin="anonymous"
    ></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./javascript/search.js"></script>
  </head>
  <body>
    <header>
      <h2>Etec</h2>
    </header>

    <main class="content">
      <div class="content-inside collection">
        <section class="section"> 
          <div class="submit-line">
            <form action="busca.php" method="post">
              <input 
                  type="text" 
                  placeholder="Pesquisar livros ou tópicos..." 
                  id="pesquisa"
                  name="pesquisa"/>
              <button class="submit-lente" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </form>
          </div>

            <?php
              if(isset($_SESSION['admin'])):
            ?>

            <button onclick="Modal.open()" 
                    class="button-more active">
                    +
            </button>

            <?php
              endif;
            ?>
        </section>

        <section class="section-table-collection">
          <table class="table-reserves">
            <thead>
              <tr>
                <th class="th-collection">Livro</th>
                <th class="th-collection" colspan="3">Autor</th>
              </tr>
            </thead>
            <tbody class="resultado"> 

              <?php while($dado = $con->fetch_array()){ ?>
              <tr>
                <td class="td-collection"><?php echo $dado['nome_liv']; ?></td>
                <td class="td-collection"><?php echo $dado['autor_liv']; ?></td>
                <td class="td-collection">
                  <form <?php echo "action='reserve-btn.php?id=" . $dado['ID_liv'] . "'" ?> method="post">
                    <button type="submit" class="reserve">RESERVAR</button>
                  </form>
                </td>
              </tr>
              <?php } ?>
              
            </tbody>
          </table>
        </section>
      </div>
    </main>

    <?php
        if(isset($_SESSION['green'])):
    ?>

    <div class="green">
      <p>Livro reservado com sucesso! </p>
    </div>
    
    <?php
      endif;
      unset($_SESSION['green']);
    ?>


    <?php
      if(isset($_SESSION['blue'])):
    ?>

    <div class="blue">
      <p>Você já reservou este livro! </p>
    </div>

    <?php 
      endif;
      unset($_SESSION['blue']);
    ?>


    <?php
      if(isset($_SESSION['red'])):
    ?>

    <div class="red">
      <p>Este livro já foi reservado por outro usuário. </p>
    </div>

    <?php 
      endif;
      unset($_SESSION['red']);
    ?>

    <?php
      if(isset($_SESSION['purple'])):
    ?>

    <div class="purple">
      <p>Você não pode reservar mais de três livros! </p>
    </div>

    <?php  
      endif;
      unset($_SESSION['purple']); 
    ?>

    <hr />

    <footer class="footer">
      <p>2021 | Etec de Araçatuba</p>
      <p id="address">
        Av. Prestes Maia, 1764 - Fone (18) 3622-0170 - Araçatuba-SP
      </p>
    </footer>

    <div class="modal-overlay">
      <div class="modal">
          <div id="form">
              <form action="processa.php" method="POST" id="mail-form">
                  <div class="input-group">
                    <h3>Nome do livro</h3>
                      <input 
                          type="text" 
                          id="names" 
                          name="nomelivro" 
                          placeholder="Ex: Helena"
                      />
                  </div>

                  <div class="input-group">
                    <h3>Autor do livro</h3>
                      <input 
                          type="text" 
                          id="names" 
                          name="autorlivro" 
                          placeholder="Ex: Machado de Assis"
                      />
                  </div>

                  <div class="input-group">
                    <h3>Tópicos</h3>
                      <input 
                          type="text" 
                          id="names" 
                          name="topicolivro" 
                          placeholder="Ex: Romance, programação, culinária..."
                      />
                  </div>

                  <div class="input-group">
                    <h3>Quantidade de exemplares</h3>
                      <input 
                          type="number" 
                          id="amount" 
                          name="quantlivro" 
                          placeholder="Ex: 5"
                      />
                  </div>

                  <div class="input-group buttons actions">
                    <a 
                        onclick="Modal.close()"
                        href="#" 
                        class="button-cancel">Cancelar</a>

                    <button 
                        type="submit"
                        class="button-save">Salvar</button>
                  </div>
              </form>           
          </div>
      </div>
  </div>

  <?php
    if(isset($_SESSION['green'])):
  ?>

  <div class="green">
    <p>Livro adicionado com sucesso!</p>
  </div>
  
  <?php
    endif;
    unset($_SESSION['green']);
  ?>


  <?php
    if(isset($_SESSION['red'])):
  ?>

  <div class="red">
    <p>Ocorreu um erro. Por favor, confira os dados e tente novamente.</p>
  </div>
  
  <?php
    endif;
    unset($_SESSION['red']);
  ?>

  <script>
  
    // modal div 
    const Modal = {
        open(){
            document
                .querySelector('.modal-overlay')
                .classList
                .add('active')
        },
        close(){
            document
                .querySelector('.modal-overlay')
                .classList
                .remove('active')
        }
    }

    // after 5 seconds the messages will disappear 
    $().ready(function() {
      setTimeout(function () {
        $('.green').hide();
        $('.red').hide();
        $('.blue').hide();
        $('.purple').hide();
      }, 7000); 
    });

  </script>
  
  </body>
</html>

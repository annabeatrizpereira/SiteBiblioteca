<?php
  // including files
  include("conexao.php");
  include("verifica_login.php");

    // if the user selected something
    if (isset($_FILES['arquivo'])){

      // getting the data thru the input
      $nomeebook = filter_input(INPUT_POST, 'nome-ebook', FILTER_SANITIZE_STRING);
      $autorebook = filter_input(INPUT_POST, 'autor-ebook', FILTER_SANITIZE_STRING);

      // getting the file submited
      $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
      $novo_nome = md5(time()) . $extensao;

      // creating a directory to send the file. it will be saved there, and not in the database
      $diretorio = "books/";
      move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);

      // inserting into the database
      $sql = "insert into ebooks(nome_ebook, autor_ebook, arquivo_ebook, data_ebook) values('$nomeebook', '$autorebook', '$novo_nome', NOW())";
      $query = mysqli_query($conexao, $sql); 

      if($query){
        $_SESSION['green'] = true;
        header("Location: ebooks.php");
        exit;
      }else{
        $_SESSION['red'] = true;
        header("Location: ebooks.php");
        exit;
      }

    }
    
    // getting the data to display later
    $sql_two = "select nome_ebook, autor_ebook, arquivo_ebook from ebooks order by nome_ebook";
    $query_two = mysqli_query($conexao, $sql_two);

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
    <title>E-books | Etec de Araçatuba</title>
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
    
    <script 
      type="text/javascript" 
      src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"
    ></script>

    <script 
      type="text/javascript" 
      src="./javascript/search_ebooks.js"
    ></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  </head>
  <body>
    <header>
      <h2>Etec</h2>
    </header>

    <main class="content">
      <div class="content-inside e-books">
        <section class="section"> 
          <div class="submit-line">
            <form action="busca_ebooks.php" method="get">
              <input 
                  id="pesquisa"
                  type="text" 
                  name="pesquisa"  
                  placeholder="Pesquisar e-books..." />

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

        <section class="table-mobile">
          <table class="table-ebooks">
            <tr>
              <th class="th-ebooks">Livro</th>
              <th class="th-ebooks" colspan="2">Autor</th>
            </tr>

            <tbody class="resultado">
              <?php
                // displaying the data selected previously
                while($dado = $query_two->fetch_array()){ 
              ?>
              <tr>
                <td class="td-ebooks"><?php echo $dado['nome_ebook'] ?></td>
                <td class="td-ebooks"><?php echo $dado['autor_ebook'] ?></td>
                <td class="td-ebooks"> <a href="./books/<?php echo $dado['arquivo_ebook'] ?>" class="reserve">DOWNLOAD</a> </td>
              </tr>
              <?php } ?>
            </tbody>

          </table>
        </section>
      </div>
    </main>

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
              <form action="ebooks.php" method="POST" enctype="multipart/form-data">
                  <div class="input-group">
                    <h3>Nome do livro</h3>
                      <input 
                          type="text" 
                          id="names" 
                          name="nome-ebook" 
                          placeholder="Ex: Helena"
                      />
                  </div>

                  <div class="input-group">
                    <h3>Autor do livro</h3>
                      <input 
                          type="text" 
                          id="names" 
                          name="autor-ebook" 
                          placeholder="Ex: Machado de Assis"
                      />
                  </div>

                  <div class="input-group input-wrapper">
                    <h3>Escolher Arquivo</h3>
                    <label 
                        for="input-file" id="file-name">Selecionar um arquivo...
                    </label>
                    <input
                        id="input-file"
                        type="file" 
                        required name="arquivo"
                    />

                    <script>
                      // a little of javascript to display the name of the file on the screen
                      var $input = document.getElementById("input-file");
                          $fileName = document.getElementById("file-name");

                      $input.addEventListener('change', function(){
                        $fileName.textContent = this.value;
                      })
                    </script>

                  </div> 

                  <div class="input-group buttons actions">
                      <a 
                          onclick="Modal.close()"
                          href="#" 
                          class="button-cancel">Cancelar</a>
                      <button type="submit" name="enviar-formulario" class="button-save">Salvar</button>
                  </div>
              </form>           
          </div>
      </div>
  </div>
  
  <?php
    if(isset($_SESSION['green'])):
  ?>

  <div class="green">
    <p>E-book adicionado com sucesso!</p>
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
      }, 5000); 
    });
  </script>
  </body>
</html>

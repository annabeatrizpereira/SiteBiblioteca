<?php
  /* including the database connection */
  include("conexao.php");
  include("verifica_login.php");
  
  /* selecting the user name */
  $email = $_SESSION['email_user'];
  $select = "select nome_user from usuario where email_user = '$email'";
  $query = mysqli_query($conexao, $select);
  $name = mysqli_fetch_assoc($query);

  /* selecting the 'emprestimo' table */
  $consulta = "select u.nome_user, l.nome_liv, l.autor_liv, e.ID_emp, e.tombo_emp, e.devolucao_emp, e.renovacao_emp from emprestimos as e "; 
  $consulta .= "join livros as l on e.ID_liv = l.ID_liv join usuario as u on e.ID_user = u.ID_user ";
  $consulta .= "where u.email_user = '$email'";
  $result = mysqli_query($conexao, $consulta);

  /* selecting the 'historico' table */
  $search = "select u.email_user, l.nome_liv, l.autor_liv, h.retorno_his from historico as h ";
  $search .= "join livros as l on h.ID_liv = l.ID_liv join usuario as u on h.ID_user = u.ID_user ";
  $search .= "where u.email_user = '$email'";
  $query_two = mysqli_query($conexao, $search);
  

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
    <title>Perfil | Etec de Araçatuba</title>
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
  </head>
  <body>
    <header>
      <h2>Etec</h2>
    </header>

    <main class="content">
      <section class="section-profile">
        <i class="fas fa-user-circle"></i>

        <!-- showing the user's name -->
        <h2><?php echo $name['nome_user']; ?></h2>

      </section>

      <div class="table-mobile">
        <table class="table-profile">
          <thead>
            <div class="link-profile">EMPRÉSTIMO</div>
          </thead>
          <tbody> 
          
            <?php 
              // displaying the data from the 'emprestimos' table
              if(($result) and ($result->num_rows != 0)){
                while($dado = $result->fetch_array()){ 
            ?>
                <tr>
                  <td class="td-profile"> 
                    <?php echo $dado["nome_liv"]; ?> - 
                    <?php echo $dado["autor_liv"]; ?>
                  </td>

                  <td class="td-profile date">
                    <?php echo date('d/m/Y', strtotime($dado["tombo_emp"])); ?> - 
                    <?php 
                      if($dado["renovacao_emp"] == 0){
                        echo date('d/m/Y', strtotime($dado["devolucao_emp"])); 
                      }elseif($dado["renovacao_emp"] != 0){
                        echo date('d/m/Y', strtotime($dado["renovacao_emp"])); 
                      }
                    ?>
                  </td>

                  <td class="td-profile" class="btn"> 
                    <form <?php echo "action='renew.php?id=" . $dado['ID_emp'] . "'" ?> method="post">
                      <button type="submit" class="renew">RENOVAR</button> 
                    </form>
                  </td>
                </tr>

                <?php }

              }else{ 
                // if there is no data registered
                echo '<tr>
                <td class="td-profile">Nenhum empréstimo pendente</td>
                <td class="td-profile">00/00/00 - 00/00/00</td>
              </tr>';
              } 
            ?>
          
          </tbody>
        </table>
      </div>

      <div class="table-mobile">
        <table class="table-profile">
          <thead>
            <div class="link-profile">HISTÓRICO</div>
          </thead>
          <tbody>
          
            <?php
              // displaying the data from the 'historico' table
              if(($query_two) and ($query_two->num_rows != 0)){ 
                while($row = mysqli_fetch_assoc($query_two)) { 
            ?>

              <tr>
                <td class='td-profile'> 
                  <?php 
                    echo $row['nome_liv'];
                    echo " - ";
                    echo $row['autor_liv']; 
                  ?> 
                </td>
                
                <td class='td-profile'> 
                  <?php 
                    echo date('d/m/Y', strtotime($row['retorno_his'])); }
                  ?> 
                </td>
              </tr>
              
            <?php 
            }else{
              // if there is no data registered
              echo '<tr>
              <td class="td-profile">Nenhum livro no histórico</td>
              <td class="td-profile">00/00/00</td>
              </tr>'; 
            } ?>

          </tbody>
        </table>
      </div>
    </main>

    <?php
      if(isset($_SESSION['green'])):
    ?>

    <div class="green">
      <p>Livro renovado! </p>
    </div>

    <?php 
      endif;
      unset($_SESSION['green']);
    ?>

    <?php
      if(isset($_SESSION['red'])):
    ?>

    <div class="red">
      <p>Algo deu errado. Por favor, tente novamente.</p>
    </div>

    <?php 
      endif;
      unset($_SESSION['red']);
    ?>

    <?php
      if(isset($_SESSION['blue'])):
    ?>

    <div class="blue">
      <p>Você não pode renovar mais do que três vezes. </p>
    </div>

    <?php 
      endif;
      unset($_SESSION['blue']);
    ?>

    <hr/>

    <footer class="footer">
      <p>2021 | Etec de Araçatuba</p>
      <p id="address">
        Av. Prestes Maia, 1764 - Fone (18) 3622-0170 - Araçatuba-SP
      </p>
    </footer>
  </body>
</html>

<script>

    // after 5 seconds the messages will disappear 
    $().ready(function() {
      setTimeout(function () {
        $('.green').hide();
        $('.red').hide();
        $('.blue').hide();
        $('.purple').hide();
      }, 4000); 
    });

</script>

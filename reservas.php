<?php
  /* including files */
  include("conexao.php");
  include("verifica_login.php");

  /* search in the database */
  $sql = "select u.nome_user, l.nome_liv, r.ID_res from reservas as r join usuario as u on r.ID_user = u.ID_user ";
  $sql .= "join livros as l on r.ID_liv = l.ID_liv order by l.nome_liv";
  $result = mysqli_query($conexao, $sql);

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
    <title>Reservas | Etec de Araçatuba</title>
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
    <script src="./javascript/search_re.js"></script>
  </head>
  <body>
    <header>
      <h2>Etec</h2>
    </header>

    <main class="content">
      <div class="content-inside collection">
        <section class="section"> 
          <div class="submit-line">
            <form action="search.php" method="post">
              <input 
                  type="text"  
                  id="pesquisa"
                  name="pesquisa" 
                  placeholder="Pesquisar livros reservados..." />
              <button class="submit-lente" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </form>
          </div>
        </section>

        <section class="section-table-reserves">
          <table class="table-reserves">
            <tr>
              <th class="th-reserves">Livro</th>
              <th class="th-reserves" colspan="3">Aluno</th>          
            </tr>
            <tbody class="resultado">

            <?php 
              /* show on the page the data from the database */
              while ($row = mysqli_fetch_assoc($result)){ 
            ?>
            <tr>
              <td class="td-reserves"><?php echo $row["nome_liv"]; ?></td>
              <td class="td-reserves"><?php echo $row["nome_user"]; ?></td>
              <td class="td-reserves">
              <a 
                  <?php echo "href='delete.php?id=" . $row["ID_res"] . "'" ?>
                  class="reserve">EXCLUIR</a> 
              </td>
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

  </div>
  
  </body>
</html>

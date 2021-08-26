<?php
  // including the database connection
  include_once("conexao.php");

  // getting the data informed by the user in the input
  $buscas = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);

  // selecting the data informed previously
  $result_buscas = "select nome_liv, autor_liv from livros where nome_liv like '%$buscas%'";
  $resultado_buscas = mysqli_query($conexao, $result_buscas);

  // if it do exist, display it on the screen
  if(($resultado_buscas) and ($resultado_buscas->num_rows != 0)){
      while($row_buscas = mysqli_fetch_assoc($resultado_buscas)){
          echo '<tr>
                  <td class="td-collection">'.$row_buscas['nome_liv'].'</td>
                  <td class="td-collection">'.$row_buscas['autor_liv'].'</td>
                  <td class="td-collection"><a href="#" class="reserve">RESERVAR</a></td>
                </tr>';
      }

  // if it doesn't, show a message informing the user
  }else{
      echo "<tr>
      <td class='no-book' colspan='3'>Nenhum livro encontrado.</td>
    </tr>";
  }

?>
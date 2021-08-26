<?php
  // including the database connection 
  include_once("conexao.php");

  // getting the data informed by the user on the input
  $buscas = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);

  // selecting the data informed
  $result_buscas = "select nome_ebook, autor_ebook, arquivo_ebook from ebooks where nome_ebook like '%$buscas%'";
  $resultado_buscas = mysqli_query($conexao, $result_buscas);

  // if the data exists, display it on the screen
  if(($resultado_buscas) and ($resultado_buscas->num_rows != 0)){
      while($row_buscas = mysqli_fetch_assoc($resultado_buscas)){
          echo '<tr>
                  <td class="td-ebooks">' .$row_buscas['nome_ebook']. '</td>
                  <td class="td-ebooks">' .$row_buscas['autor_ebook']. '</td>
                  <td class="td-ebooks"> <a href="./books/'.$row_buscas['arquivo_ebook'].'" class="reserve">DOWNLOAD</a> </td>
                </tr>';
      }
  // if it doesn't, show a message informing the user
  }else{
      echo "<tr>
      <td class='no-book' colspan='3'>Nenhum livro encontrado.</td>
    </tr>";
  }

?>
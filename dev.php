<?php
  /* starting the session and including the database connection */
  session_start();
  include("conexao.php");

  /* catching the values from the input */
  $aluno = filter_input(INPUT_POST, 'nome-aluno', FILTER_SANITIZE_STRING);
  $livro = filter_input(INPUT_POST, 'nome-livro', FILTER_SANITIZE_STRING);
  $devolucao = filter_input(INPUT_POST, 'data-devolucao', FILTER_SANITIZE_STRING);

  /* transforming the name into an id */
  $select = "select ID_user from usuario where nome_user = '$aluno'";
  $query = mysqli_query($conexao, $select);
  $row = mysqli_fetch_assoc($query);
  $id_student = $row['ID_user'];

  /* also transforming the name into an id */
  $select_two = "select ID_liv from livros where nome_liv = '$livro'";
  $query_two = mysqli_query($conexao, $select_two);
  $row_two = mysqli_fetch_assoc($query_two);
  $id_book = $row_two['ID_liv'];

  /* inserting the data into the table 'historico' */
  $sql = "insert into historico (ID_his, ID_user, ID_liv, retorno_his, data_his) values (default, '$id_student', '$id_book', '$devolucao', now())";
  $result = mysqli_query($conexao, $sql);

  /* deleting the data from the table 'emprestimos' */
  $del = "delete from emprestimos where ID_user = '$id_student' and ID_liv = '$id_book'";
  $result_two = mysqli_query($conexao, $del);

  /* redirecting the page and showing a message if everything went fine */
  if(mysqli_affected_rows($conexao)){
    $_SESSION['fine'] = true;
    header("Location: devolution.php");
    exit;
  }
  
  /* redirecting the page and showing a message if something went wrong */
  if($id_student == 0 || $id_book == 0){
    $_SESSION['bad'] = true;
    header("Location: devolution.php");
    exit;
  }
?> 
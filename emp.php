<?php
  session_start();
  include("conexao.php");

  /* getting the values thru the input */
  $aluno = filter_input(INPUT_POST, 'aluno', FILTER_SANITIZE_STRING);
  $livro = filter_input(INPUT_POST, 'livro', FILTER_SANITIZE_STRING);
  $tombo = filter_input(INPUT_POST, 'tombo', FILTER_SANITIZE_STRING);
  $devolucao = filter_input(INPUT_POST, 'dev', FILTER_SANITIZE_STRING);

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

  /* inserting the values into the database */
  $sql = "insert into emprestimos (ID_emp, ID_user, ID_liv, tombo_emp, devolucao_emp, data_emp) values (default, '$id_student', '$id_book', '$tombo', '$devolucao', NOW())";
  
  /* showing a messange if everything went ok and redirecting the page */
  if(mysqli_query($conexao, $sql)){
    $_SESSION['fine'] = true;
    header("Location: emprestimo.php");
    exit;
  }
  
   /* showing a message if something went wrong and redirecting the page */
  if($id_student == 0 || $id_book == 0){
    $_SESSION['bad'] = true;
    header("Location: emprestimo.php");
    exit;
  }

?>